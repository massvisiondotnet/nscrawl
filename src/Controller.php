<?php

require_once __DIR__ . '/Parser.php';
require_once __DIR__ . '/LinksCrawler.php';
require_once __DIR__ . '/DetailsCrawler.php';
require_once __DIR__ . '/Stats.php';

const NUM_PAGES = 1000;

class Controller {

    public function deploy() {
        switch ($_GET['cmd']) {
            case 'get-all':
                $this->getAll();
                break;
            case 'get-details':
                break;
            default:
                echo Parser::getNew('index')->display();
        }
    }

    public function getAll() {
        /** @var Details[] $details */
        $details = array();
        $usedLinks = array();
        $t = microtime(true);
        $l = new LinksCrawler();
        $d = new DetailsCrawler();
        foreach (
            array(
                'https://www.nekretnine.rs/stambeni-objekti/stanovi/izdavanje-prodaja/prodaja/grad/beograd/cena/0_60000/lista/po_stranici/10/stranica/%d',
                'https://www.nekretnine.rs/stambeni-objekti/stanovi/izdavanje-prodaja/prodaja/grad/beograd/cena/60000_110000/lista/po_stranici/10/stranica/%d',
                'https://www.nekretnine.rs/stambeni-objekti/stanovi/izdavanje-prodaja/prodaja/grad/beograd/cena/110000_2500000/lista/po_stranici/10/stranica/%d',
            ) as $linkPattern)
        {
            for ($i = 1; $i <= NUM_PAGES; $i++) {
                foreach ($l->getLinks($linkPattern, $i) as $link) {
                    if (!in_array($link, $usedLinks)) {
                        $usedLinks[] = $link;
                    } else {
                        Stats::getInstance()->incDuplicateLinksCount();
                    }
                }
                if (!$l->hasMore())
                    break;
            }
        }
        foreach ($usedLinks as $link) {
            $linkDetails = $d->getDetails($link);
            if ($linkDetails)
                $details[] = $linkDetails;
        }
        if (count($details)) {
            $lines = array();
            $isFirst = true;
            foreach ($details as $d) {
                if ($isFirst) {
                    $lines[] = $d->toCsvHeader();
                    $isFirst = false;
                }
                $lines[] = $d->toCsvRow();
            }
            file_put_contents(__DIR__ . '/../out/out.csv', implode("\n", $lines));
        }
        Stats::getInstance()->addTotalTime(microtime(true) - $t);
        $str = sprintf(
            "%s\n%s\n----------------------------\n",
            date('Y-m-d H:i:s'),
            Stats::getInstance()->getStats()
        );
        file_put_contents(__DIR__ . '/../out/log', $str, FILE_APPEND|LOCK_EX);
        echo $str;
        exit(1);
    }
}