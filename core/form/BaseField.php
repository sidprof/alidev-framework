<?php 
    namespace app\core\form;
    use app\core\Model;

   abstract class BaseField
    {
        public string $attribute;
        public Model $model;
        public $textGourp = false;

        abstract public function field(): string;

        public function __construct($attribute, $model){
            $this->attribute = $attribute;
            $this->model = $model;
        }

        public function __toString(){
            return sprintf(
                '<div class="form-group mb-3">
                    <label for=""><b>%s:</b></label>
                    %s
                    <div class="invalid-feedback">
                        <b> %s </b>
                    </div>
                    %s
                </div>',
                $this->label(),
                $this->field(),
                $this->model->getFirstError($this->attribute),
                $this->textGourp ? "</div>" : "",

            );
        }

        public function label(){
            $label = preg_replace('/[A-Z]/', ' $0', $this->attribute);
            return ucfirst($label);
        }

       
        

        
       

    }


?>