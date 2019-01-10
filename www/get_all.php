<?php

// nohup php get_all.php &

require_once __DIR__ . '/../src/Controller.php';
$ctl = new Controller();
$ctl->getAll();
