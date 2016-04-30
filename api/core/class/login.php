<?php

class Login
{
    private function __construct()
    {
    }
    
    public static function login()
    {
        if (!isset($_POST['mail']) || !isset($_POST['password'])) {
            return false;
        }
        
        $mail = $_POST['mail'];
        $mail = htmlspecialchars($mail);
        $mail = strtolower($mail);
        
        $password = $_POST['password'];
        $password = htmlspecialchars($password);
        
        $Model = new UserModel();
        $loginCheck = $Model->tryLogin($mail, $password);
        
        if (!$loginCheck) {
            return false;
        }
        
        while (true) :
            $sid = sha1(uniqid(microtime()));
            $checkSession = $Model->checkSession($sid);
            if (!$checkSession) {
                break;
            }
        endwhile;
        
        $Model->registSession($mail, $sid);
        
        $_SESSION['C-Factory']['sid'] = $sid;
        
        $array = array(
            "statusCode" => 200,
            "data" => array(
                "loginResult" => true
            ),
        );
        $json = json_encode($array, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        
        header("Content-Type: application/json; charset=utf-8");
        echo $json;
        
        return true;
    }
    
    public static function logout()
    {
        if (isset($_SESSION['C-Factory']['sid'])) {
            $sid = $_SESSION['C-Factory']['sid'];
            
            $Model = new UserModel();
            $tryLogout = $Model->deleteSession($sid);
        }
        
        $_SESSION = array();
        
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        session_destroy();
    }
}
