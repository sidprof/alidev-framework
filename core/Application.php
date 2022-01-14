<?php 
    namespace app\core;
    use app\models\User;

    class Application
    {
        public static Application $app;
        public static $ROOT_DIR;

        public Router $router;
        public Request $request;
        public Response $response;
        public Database $database;
        public Session $session;
        public View $view;

        public DbModel $user;

        public function __construct($rootDir, $config){
            self::$app = $this;
            self::$ROOT_DIR = $rootDir;

            $this->request = new Request;
            $this->response = new Response;
            $this->session = new Session;
            $this->database = new Database($config['db']);
            $this->view = new View();
            $this->router = new Router($this->request, $this->response);

            $user_id = $this->session->getUserId();
            if($user_id){
                $primaryKey = User::primaryKey(); 
                $this->user = User::findByWhere([$primaryKey=>$user_id]);
            }

        }
  
        public function run(){
            try {

                echo $this->router->resolve();  

            } catch (\Exception $e) {
                $this->response->setStatusCode($e->getCode());
                echo $this->view->renderView("__exception",[
                    "e"=>$e,
                ]);

            }
        }
    }


?>