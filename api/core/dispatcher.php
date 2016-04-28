<?php

require_once $__DIR__ . '/core/define.php';
require_once $__DIR__ . '/core/key.php';
require_once $__DIR__ . '/core/class/model.php';
require_once $__DIR__ . '/core/class/login.php';

$params = array();
$params = explode('/', $_SERVER['REQUEST_URI']);

switch ( $params[1] ) {
    case 'test':
        
        $array = array(
            "statusCode" => 200,
            "data" => array(
                "message" => "Test Success!",
                "url" => "http://c.jpn.io/",
            ),
        );
        $json = json_encode($array, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        
        header("Content-Type: application/json; charset=utf-8");
        echo $json;
        
        break;
        
    case 'login':
        Login::login();
        break;
        
    case 'logout':
        Login::logout();
        break;
        
    default:
        header("HTTP/1.0 404 Not Found");
        exit;
        break;
}
