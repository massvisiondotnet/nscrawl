
<?php

require_once __DIR__ . '/../src/DetailsCrawler.php';
require_once __DIR__ . '/../src/Phones.php';


$p = Phones::getInstance();
$d = new DetailsCrawler();
print_r($p->getById(2039822));
print_r($p->getById(2039822, true));
print_r($d->getDetails('https://www.nekretnine.rs/stambeni-objekti/stanovi/stan-u-vili-u-neposrednoj-blizini-hrama-svsave-uknjizen-rankeova/2039822/'));
