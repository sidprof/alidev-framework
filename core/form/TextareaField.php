<?php 

    namespace app\core\form;

    class TextareaField extends BaseField
    {
        public function field():string{

            return sprintf(
                '<textarea name="%s" class="form-control %s"></textarea>',
                $this->attribute,
                $this->model->hasErrors($this->attribute) ? 'is-invalid' : '',
            );
        
        }
    }


?>