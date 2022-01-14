<?php 
    namespace app\controllers;
    use app\core\Application;
    use app\core\Controller;
    use app\core\Request;
    use app\core\Response;
    use app\models\ContactModel;

    class SiteController extends Controller {
        
    public function home(){
        return $this->render("home");
    }

    public function profile(){
        return $this->render("profile");
    }

    public function contact(Request $request, Response $response){
        $contactModel = new ContactModel();
        if($request->isPost()){
            $contactModel->loadData($request->getMethodData());
            if($contactModel->validate()){
                echo "validated";
            }
        }
        return $this->render("contact", [
            "model"=>$contactModel,
        ]);
    }

    }

?>