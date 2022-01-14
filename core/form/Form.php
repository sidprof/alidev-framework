<?php 
    namespace app\core\form;


    class Form {

        public static function begin(string $action, string $method){
            echo "<form action=\"{$action}\" method=\"{$method}\">";
            return new Form;
        }

        public function inputField($attribute, $model){
            return new InputField($attribute, $model);
        }
        public function textareaField($attribute, $model){
            return new TextareaField($attribute, $model);
        }

        public function end(){
            return "</form>";
        }

    }

?>