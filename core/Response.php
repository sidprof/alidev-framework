<?php 
    namespace app\core;

    class Response {
        public function setStatusCode($code){
            return http_response_code($code);
        }

        public function redirect_to($location){
            header("Location: " . $location);
            exit;
        }
    }


?>