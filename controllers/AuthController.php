<?php 
    namespace app\controllers;
    use app\core\Application;
    use app\core\Request;
    use app\core\Response;
    use app\core\Controller;

    use app\models\User;
    use app\models\LoginModel;

    class AuthController extends Controller {

        public function login(Request $request, Response $response){
            $loginModel = new LoginModel();
            if($request->isPost()){
                $loginModel->loadData($request->getMethodData());
                if($loginModel->validate() && $user = $loginModel->authenticatedUser()){
                   Application::$app->session->setFlush("user", "Welcome " . $user->name());
                   return $response->redirect_to("/");
                }
            }


            return $this->render("login", [
                "model"=>$loginModel
            ]);
        }


        public function logout(Request $request, Response $response){
            Application::$app->session->logout();
            return  $response->redirect_to("/login");    
        }


        public function register(Request $request, Response $response){
            $userObject = new User();
            if($request->isPost()){
                $userObject->loadData($request->getMethodData());
                if($userObject->validate() && $userObject->save()){
                     Application::$app->session->setFlush("user", "Thank you for the registration.");
                     return $response->redirect_to("/");
                }
            }

            return $this->render("register", [
                "model"=>$userObject,
            ]);
        }

    }


?>