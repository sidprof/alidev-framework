<?php 
    namespace app\core;

    class Request {

        public function getMethod(){
            return strtolower($_SERVER["REQUEST_METHOD"]);
        }

        public function getPath(){
            $path = $_SERVER["REQUEST_URI"];
            $position = strpos($path, "?");
            if($position){
                return substr($path, 0, $position);
            }
            return $path;
        }

        public function isGet(){
            return strtolower($_SERVER["REQUEST_METHOD"]) === "get";
        }

        public function isPost(){
            return strtolower($_SERVER["REQUEST_METHOD"]) === "post";
        }

        public function getMethodData() // method(post, get)
        {
            $data = [];
            if($this->isGet()){
                foreach($_GET as $key=>$value){
                    $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }

            }
            if($this->isPost()){
                foreach($_POST as $key=>$value){
                    $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
            return $data;
        }

    }

?>