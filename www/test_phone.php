
<?php

require_once __DIR__ . '/../src/DetailsCrawler.php';
require_once __DIR__ . '/../src/Phones.php';


$p = Phones::getInstance();
$d = new DetailsCrawler();
print_r($p->getById(227185));
print_r($p->getById(227185, true));
print_r($d->getDetails('https://www.nekretnine.rs/stambeni-objekti/stanovi/petra-lekovica-stan-dvoriste-i-garaza/138270/'));
