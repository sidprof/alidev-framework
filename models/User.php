<?php 
    namespace app\models;
    use app\core\DbModel;

    class User extends DbModel
    {
        public int $id;
        public string $firstname;
        public string $lastname;
        public string $email;
        public string $password;
        public int $status = 0;
        public string $confirmPassword;

        public static function primaryKey() : string {
            return "id";
        }

        public static function tableName():string {
            return "users";
        }

        public static function attributes() : array {
            return ['firstname', 'lastname', 'email', 'password', 'status'];
        }

        public function name(){
            return $this->firstname . " " . $this->lastname;
        }

        public function rules():array {
            return[
                "firstname" => [self::RULE_REQUIRED, [self::RULE_MAX, "max"=>30], [self::RULE_MIN, "min"=>3]], 
                "lastname" => [self::RULE_REQUIRED, [self::RULE_MAX, "max"=>30], [self::RULE_MIN, "min"=>3]], 
                "email" => [self::RULE_REQUIRED, [self::RULE_MAX, "max"=>30], self::RULE_EMAIL, self::RULE_UNIQUE], 
                "password" => [self::RULE_REQUIRED, [self::RULE_MAX, "max"=>30], [self::RULE_MIN, "min"=>3], self::RULE_UC, self::RULE_LC], 
                "confirmPassword" => [self::RULE_REQUIRED, [self::RULE_MAX, "max"=>30], [self::RULE_MIN, "min"=>3], self::RULE_UC, self::RULE_LC], 
            ];
        }

        public function save(){
            $this->password = password_hash($this->password, PASSWORD_BCRYPT);
            return parent::save();
        }
    }


?>