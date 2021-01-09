<?php

namespace App;

class Session
{
    public $user_id;
    public $user_name;
    public $message;
    /**
     * Session constructor.
     * Check user session
     */
    public function __construct()
    {
        if(isset($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
        }
        if(isset($_SESSION['user_name'])){
            $this->user_name = $_SESSION['user_name'];
        }
    }

    public function getName()
    {
        return $this->user_name;
    }

    /**
     * ser UserID
     * @param $user_id
     */
    function setUserId($user_id)
    {
        $this->user_id=$user_id;
    }

    /**
     * ser UserName
     * @param $user_id
     */
    function setUserName($user_name)
    {
        $this->user_name=$user_name;
    }

    /**
     * Check user is logged
     * @return bool
     */
    public function isLogged()
    {
        if($this->user_id!=null){
            if( $this->checkSession() ) return $this->checkSession();
            return true;
        }
        return false;
    }

    /**
     * Check Session
     */
    public function checkSession(){

        // Expiration Date
        if($_SESSION['expires']<=date('Y-m-d H:i:s')){
            session_destroy();
            return header('Location: index.php');
        }
    }

}