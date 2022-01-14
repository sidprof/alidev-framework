<?php 
    namespace app\models;
    use app\core\Model;

    class ContactModel extends Model
    {
        public $subject;
        public $email;
        public $body;

        public function rules():array {
            return [
                "subject"=>[self::RULE_REQUIRED],
                "email"=>[self::RULE_REQUIRED, self::RULE_EMAIL],
                "body"=>[self::RULE_REQUIRED],
            ];
        }
    }


?>