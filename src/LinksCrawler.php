<?php

require_once __DIR__ . '/XmlParser.php';
require_once __DIR__  . '/Stats.php';

class LinksCrawler {

    private $xmlParser = null;

    public function __construct() {
        $this->xmlParser = new XmlParser();
    }

    public function getLinks($pageNr) {
        file_put_contents(
            __DIR__ . '/../out/log',
            sprintf(
                "%s - reading links page %d\n",
                date('Y-m-d H:i:s'),
                $pageNr
            ),
            FILE_APPEND|LOCK_EX
        );
        $links = array();
        $t = microtime(true);
        $html = file_get_contents(
            sprintf(
                'https://www.nekretnine.rs/stambeni-objekti/stanovi/izdavanje-prodaja/'.
                'prodaja/grad/beograd/lista/po_stranici/10/stranica/%d?order=6',
                $pageNr
            )
        );
        Stats::getInstance()->addTimeDownloading(microtime(true) - $t);
        Stats::getInstance()->incOverviewPagesCount();
        $t = microtime(true);
        // get chunks
        $chunks = preg_split('/<div\sclass="row\soffer">/', $html);
        // read premium for first page
        if ($pageNr == 1)
            $links = $this->getHeaderLinks($chunks[0]);
        array_shift($chunks);  // remove first, useless (premium slider is there)
        // clean up last chunk
        $chunks[count($chunks) - 1] = preg_replace(
            '/<div\sclass="col\-auto\scol\-md\-12\sm\-auto\spage\-numbers\sw\-100">.*/ms',
            '',
            $chunks[count($chunks) - 1]
        );

        foreach ($chunks as $chunk) {
            if (preg_match(
                '/<a\shref="(\/stambeni\-objekti\/stanovi\/[^"]*)">/ms',
                $chunk,
                $matches
            ))
                $links[] = 'https://www.nekretnine.rs' . $matches[1];
        }
        Stats::getInstance()->addTimeParsing(microtime(true) - $t);
        return $links;
    }

    private function getHeaderLinks($html) {
        $links = array();
        $chunks = preg_split('/data\-premium\-offer\-item/', $html);
        foreach ($chunks as $chunk) {
            if (preg_match(
                '/<a\shref="(\/stambeni\-objekti\/stanovi\/[^"]*)">/ms',
                $chunk,
                $matches
            ))
                $links[] = 'https://www.nekretnine.rs' . $matches[1];
        }
        // echo "<pre>"; print_r($links); echo "</pre>"; die;
        return $links;
    }
}