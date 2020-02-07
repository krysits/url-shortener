<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../autoload.php';

use Shortener\App;

(new App)->addUrl();
