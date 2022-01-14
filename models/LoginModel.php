<?php 
    namespace app\models;
    use app\core\Application;
    use app\core\Model;

    class LoginModel extends Model {
        public string $email;
        public string $password;

        public function rules() : array {
            return [
                "email" => [self::RULE_REQUIRED, self::RULE_EMAIL],
                "password" => [self::RULE_REQUIRED],
            ];
        }

        public function authenticatedUser(){
            $user = User::findByWhere(["email"=>$this->email]);
            if(empty($user)){
                $this->addError("email", "The Email does not exist!");
                return false;
            }
            if(!password_verify($this->password, $user->password)){
                $this->addError("password", "The password is incorrect!");
                return false;
            }

            return Application::$app->session->login($user);
        }
    }


?>