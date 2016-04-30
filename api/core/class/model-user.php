<?php

class UserModel extends Model
{
    /**
     * メールアドレスとパスワードに合うユーザーの存在をチェックする。
     * 存在する場合はtrue、しない場合はfalseを返す。
     *
     * @param str $mail
     * @param str $password
     *
     * @return bool
     */
     
    public function tryLogin($mail, $password)
    {
        $sql = "SELECT `mail`, `password` FROM `User` WHERE `mail` = '$mail' AND `invalid` = 0 LIMIT 1;";
        $user = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        
        if (null == $user) {
            return false;
        }
        
        if (!password_verify($password, $user['password'])) {
            return false;
        }
        
        return true;
    }
    
    
    /**
     * セッションIDの存在をチェックする。
     * 存在する場合はtrue、しない場合はfalseを返す。
     *
     * @param str $sid
     *
     * @return bool
     */
     
    public function checkSession($sid)
    {
        $sql = "SELECT `sid` FROM `User` WHERE `sid` = '$sid' LIMIT 1;";
        $user = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        
        if (null == $user) {
            return false;
        }
        
        return true;
    }
    
    
    /**
     * セッションIDを登録する。
     * 結果のboolを返す。
     *
     * @param str $mail
     *
     * @return bool
     */
     
    public function registSession($mail, $sid)
    {
        $sql = "UPDATE `User` SET `sid` = :sid WHERE `mail` = '$mail' AND `invalid` = 0;";
        $update = $this->db->prepare($sql);
        $update->bindValue(':sid', $sid);
        $update->execute();
        
        return true;
    }
    
    
    /**
     * セッションを破棄する。
     * 結果のboolを返す。
     *
     * @param str $sid
     *
     * @return bool
     */
     
    public function deleteSession($sid)
    {
        $sql = "UPDATE `User` SET `sid` = :sid WHERE `sid` = '$sid';";
        $update = $this->db->prepare($sql);
        $update->bindValue(':sid', null);
        $update->execute();
        
        return true;
    }
}
