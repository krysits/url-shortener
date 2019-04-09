<?php
$ignored = [__DIR__ . '/autoload.php'];
foreach (glob(__DIR__ . "/*.php") as $filename) {
    if(!in_array($filename, $ignored)) require_once $filename;
}

