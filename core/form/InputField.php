<?php 
    namespace app\core\form;

    class InputField extends BaseField
    {
        
        public string $type = "text";
        public string $inputGroupText = "";

        public function field():string{
            return sprintf(
                '%s <input type="%s" name="%s" class="form-control %s">  ',
                $this->inputGroupText,
                $this->type,
                $this->attribute,
                $this->model->hasErrors($this->attribute) ? 'is-invalid' : '',
                    
            );

        }

        public function passwordType(){
            $this->type = "password";
            return  $this;
        }

        public function emailType(){
            $this->type = "email";
            return  $this;
        }

        public function inputGroup($fa){
            $this->textGourp = true;
            $this->inputGroupText = "
            <div class=\"input-group\">
                <span class=\"input-group-text\"><i class=\"fas fa-{$fa}\"></i></span>
            ";
             return $this;
         }
    }



?>