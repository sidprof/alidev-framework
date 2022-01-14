<?php 

    namespace app\core;

    abstract class Model
    {
        public const RULE_REQUIRED = "required";
        public const RULE_MAX = "max";
        public const RULE_MIN = "min";
        public const RULE_EMAIL = "email";
        public const RULE_UNIQUE = "uniqueness";
        public const RULE_UC = "uppercase";
        public const RULE_LC = "lowercase";
        public array $errors = [];

        abstract public function rules() : array;

        public function loadData(array $data){
            foreach($data as $key=>$value){
                if(property_exists($this, $key)){
                    $this->$key = $value;
                }
            }
        }

        public function validate(){
            foreach($this->rules() as $property=>$rules){
                $value = $this->$property;
                foreach($rules as $rule){
                    $rulename = $rule;
                    if(is_array($rule)){
                        $rulename = $rule[0];
                    }
                    if($rulename == self::RULE_REQUIRED && (trim($value)=="" || !isset($value))){
                        $this->addRuleErrors($property, self::RULE_REQUIRED);
                    }
                    if($rulename == self::RULE_MAX && strlen($value) > $rule["max"]){
                        $this->addRuleErrors($property, self::RULE_MAX);
                    }
                    if($rulename == self::RULE_MIN && strlen($value) < $rule["min"]){
                        $this->addRuleErrors($property, self::RULE_MIN);
                    }
                    if($rulename == self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)){
                        $this->addRuleErrors($property, self::RULE_EMAIL);
                    }
                    if($rulename == self::RULE_UNIQUE && !$this->uniqueness()){
                        $this->addRuleErrors($property, self::RULE_UNIQUE);
                    }
                    if($rulename == self::RULE_UC && !preg_match('/[A-Z]/', $value)){
                        $this->addRuleErrors($property, self::RULE_UC);
                    }
                    if($rulename == self::RULE_LC && !preg_match('/[a-z]/', $value)){
                        $this->addRuleErrors($property, self::RULE_LC);
                    }

                }

            }
            return empty($this->errors);
        }

        public function addRuleErrors($property, $rulename){
            $this->errors[$property][] = $this->errorMessages()[$rulename];
        }

        public function addError($property, $message){
            $this->errors[$property][] = $message;
        }

        public function errorMessages(){
            return [
                self::RULE_REQUIRED => "This field is required.",
                self::RULE_MAX => "This field length was too long.",
                self::RULE_MIN => "This field length was too small.",
                self::RULE_EMAIL => "This email is invalid.",
                self::RULE_UNIQUE => "This field must be unique.",
                self::RULE_UC => "This field must contain at least one uppercase letter.",
                self::RULE_LC => "This field must contain at least one lowercase letter.",
            ];
        }

        public function hasErrors($property){
            return !empty($this->errors[$property]);
        }

        public function getFirstError($property){
            return $this->errors[$property][0] ?? false;
        }

        public function uniqueness(){
            $object = static::findByWhere(["email"=>$this->email]);
            if(empty($object)){
                return true;
            }else{
                return false;
            }
        }

        

        
    }


?>