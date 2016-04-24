<?php

// MySQL接続情報

switch ( $__DIR__ ) {
    
    case SYSTEM_PATH :
        $dbInfo = array (
            'host'     => '',
            'dbname'   => '',
            'dbuser'   => '',
            'password' => ''
        );
        break;
    
    case SYSTEM_TEST_PATH :
        $dbInfo = array (
            'host'     => '',
            'dbname'   => '',
            'dbuser'   => '',
            'password' => ''
        );
        break;
    
    default :
        $dbInfo = array();
    
}
