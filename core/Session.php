<?php 
    namespace app\core;
    use app\models\User;

    class Session {

        public function __construct(){
            session_start();
            $_SESSION["remove"] = true;
        }

        public function setFlush($key, $message){
            $_SESSION["remove"] = false;
            $_SESSION["flush_messages"][$key] = $message;
        }

        public function getFlush($key){
            return $_SESSION[$key];
        }

        public function __destruct(){
            if($_SESSION["remove"]){
                unset($_SESSION["flush_messages"]);
            }
        }

        public function displayFlush($key, $state){
            $msg = "";
            if(isset($_SESSION["flush_messages"])){
                $msg .= "<div class=\"alert alert-{$state}\">";
                $msg .= $_SESSION["flush_messages"][$key];
                $msg .= '</div>';
            }
            return $msg;
        }

        //ABOUT LOGIN 

        public function login(DbModel $user){
            session_regenerate_id();
            $primaryKey = User::primarykey();
            $_SESSION["user_id"] = $user->$primaryKey;
            return $user;
        }

        public function getUserId(){
            return $_SESSION["user_id"] ?? false;
        }


        public function isGuest(){
            return !isset($_SESSION["user_id"]) ?? false;
        }

        public function logout(){
            if(isset($_SESSION["user_id"])){
                unset($_SESSION["user_id"]);
            }
            return true;
        }

    }




?>