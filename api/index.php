<?php

$debug = true;

if ( $debug ) {
    ini_set('display_errors', On);
    error_reporting(E_ALL);
}

$__DIR__ = dirname(__FILE__);

require $__DIR__ . '/core/dispatcher.php';
