<?php 
    namespace app\core\middlewares;
    use app\core\Application;
    use app\core\exceptions\ForbiddenException;

    class AuthMiddleware
    {
        public array $actions = [];

        public function __construct(array $actions = []){
            $this->actions = $actions;
        }
        public function execute(){
            if(Application::$app->session->isGuest()){
                if(empty($this->actions) || in_array(Application::$app->request->getPath(), $this->actions)){
                    throw new ForbiddenException();
                }
            }
        }
    }





?>