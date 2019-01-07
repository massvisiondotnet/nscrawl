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
        $t = microtime(true);
        $l = new LinksCrawler();
        $d = new DetailsCrawler();
        for ($i = 1; $i <= NUM_PAGES; $i++) {
            foreach ($l->getLinks($i) as $link) {
                $linkDetails = $d->getDetails($link);
                // $linkDetails = $d->getDetails('https://www.nekretnine.rs/stambeni-objekti/stanovi/1864311/stan-kod-metroa-uknjizen/');
                if ($linkDetails)
                    $details[] = $linkDetails;
            }
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