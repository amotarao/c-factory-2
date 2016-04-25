<?php

class Login
{
    public function __construct ()
    {
        $mail = $_POST['mail'];
        $mail = htmlspecialchars($mail);
        $mail = strtolower($mail);
        
        $password = $_POST['password'];
        $password = htmlspecialchars($password);
        
//        $result = Model::tryLogin($mail, $password);
        $Model = new Model();
        $loginCheck = $Model->tryLogin($mail, $password);
        
        var_dump($result);
    }
}
