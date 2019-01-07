<?php

require_once __DIR__ . '/Details.php';
require_once __DIR__ . '/XmlParser.php';
require_once __DIR__ . '/Stats.php';

class DetailsCrawler {
    /** @var XmlParser */
    private $parser;

    public function __construct() {
        $this->parser = new XmlParser();
    }

    public function getDetails($link) {
        $details = null;
        $t = microtime(true);
        $html = file_get_contents($link);
        Stats::getInstance()->addTimeDownloading(microtime(true) - $t);
        Stats::getInstance()->incDetailsPagesCount();
        $t = microtime(true);
        $html = preg_replace('/.*<h1\sclass="deatil\-title\spt\-4\spb\-4">/ms', '', $html);
        $html = preg_replace('/<div\sclass="footer\-section\sfooter\-main">.*/ms', '', $html);
        if (strlen($html)) {
            $details = new Details();
            $details->setID($link);
            //if (preg_match('/\/stanovi\/(\d+)\//', $link, $matches)) {
            //    $details->setID($matches[1]);
            //}
            $title = preg_replace('/<\/h1>.*/ms', '', $html);
            $details->setNaslov(trim($title));
            list($baseInfo, $rest) = preg_split('/<div\sclass="updated">/', $html);
            $chunks = preg_split('/<dl\sclass="dl\-horozontal">/', $baseInfo);
            if (count($chunks)) {
                array_shift($chunks);
                $detailsInfo = array();
                foreach ($chunks as $chunk) {
                    $titleTags = $this->parser->getAllWrappedInTag($chunk, 'dt');
                    $valueTags = $this->parser->getAllWrappedInTag($chunk, 'dd');
                    if (count($titleTags) && count($valueTags)) {
                        $detailsInfo[
                        trim(preg_replace('/\:|\&nbsp\;/', '', $titleTags[0]))
                        ] = trim($valueTags[0]);
                    }
                }
                if (isset($detailsInfo['Deo Grada']))
                    $details->setLokacija($detailsInfo['Deo Grada']);
                if (isset($detailsInfo['Street']))
                    $details->setAdresa($detailsInfo['Street']);
                if (isset($detailsInfo['Kategorija']))
                    $details->setStruktura($detailsInfo['Kategorija']);
                if (isset($detailsInfo['Kvadratura'])) {
                    if (preg_match('/^(\d+)/', $detailsInfo['Kvadratura'], $matches))
                        $details->setKvadratura($matches[1]);
                }
            }
            if (preg_match('/<span>Ažuriran:\s(\d+\.\d+\.\d+)<\/span>/', $rest, $matches)) {
                $details->setDatum(trim($matches[1]));
            }
            //if (preg_match('/<span>Objavljen:\s(\d+\.\d+\.\d+)<\/span>/', $rest, $matches)) {
            //    $details->setDatum(trim($matches[1]));
            //}

            list($trash, $rest) = preg_split('/<div\sclass="cms-content-inner"[^>]*>/', $rest);
            list($description, $rest) = preg_split('/<\/div>/', $rest, 2);
            $details->setOpis(trim($description));
            list($trash, $moreInfo, $rest) = preg_split('/<hr\sclass="mb\-4"[^>]*>/', $rest, 3);
            $chunks = preg_split('/<div\sclass="col-sm-6">/', $moreInfo);
            $moreDetailsInfo = array();
            if (count($chunks)) {
                array_shift($chunks);
                foreach ($chunks as $chunk) {
                    $titleTags = $this->parser->getAllWrappedInTag($chunk, 'dt');
                    $valueTags = $this->parser->getAllWrappedInTag($chunk, 'dd');
                    if (count($titleTags) && count($valueTags)) {
                        $moreDetailsInfo[
                        trim(preg_replace('/\:|\&nbsp\;/', '', $titleTags[0]))
                        ] = trim($valueTags[0]);
                    }
                }
                //if (isset($moreDetailsInfo['Ukupan broj soba']))
                //    $details->setStruktura($moreDetailsInfo['Ukupan broj soba']);
                if (isset($moreDetailsInfo['Ukupan broj spratova']))
                    $details->setUkupnoSpratova($moreDetailsInfo['Ukupan broj spratova']);
                if (isset($moreDetailsInfo['Sprat']))
                    $details->setSprat($moreDetailsInfo['Sprat']);
                if (isset($moreDetailsInfo['Grejanje']))
                    $details->setGrejanje($moreDetailsInfo['Grejanje']);
                if (isset($moreDetailsInfo['Uknjiženo']))
                    $details->setUknjizen($moreDetailsInfo['Uknjiženo']);
                if (isset($moreDetailsInfo['Godina izgradnje']))
                    $details->setGodGradnje($moreDetailsInfo['Godina izgradnje']);
                if (isset($moreDetailsInfo['Opremljenost objekta'])) {
                    if (preg_match('/terasa/i', $moreDetailsInfo['Opremljenost objekta']))
                        $details->setTerasaLodja('Terasa');
                    if (preg_match('/lođa/i', $moreDetailsInfo['Opremljenost objekta']))
                        $details->setTerasaLodja('Lođa');
                    if (preg_match('/lift/i', $moreDetailsInfo['Opremljenost objekta']))
                        $details->setLift('Da');
                }

            }

            list($trash, $rest) = preg_split('/<div[^>]+aside-broker-box[^>]*>/', $rest);
            list($priceBox, $rest) = preg_split('/<div\sclass=[^>]+contact-body[^>]*>/', $rest);
            list($trash, $priceBox) = preg_split('/Cena\simovine/', $priceBox);
            list($priceBox, $trash) = preg_split('/<\/span>/', $priceBox);
            $details->setCena(trim(strip_tags($priceBox)));
            if (preg_match('/"\/form\/show-phone-number\/([^"]*)"/', $rest, $matches)) {
                @list($phone1, $phone2) = explode(',', $matches[1], 2);
                if (isset($phone1))
                    $details->setTelefon1(trim($phone1));
                if (isset($phone2))
                    $details->setTelefon2(trim($phone2));
            }
        }
        //print_r($details); die;
        Stats::getInstance()->addTimeParsing(microtime(true) - $t);
        return $details;
    }
}