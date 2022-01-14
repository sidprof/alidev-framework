<?php 
    namespace app\core;

    class View
    {
        public string $title = "";

        public function renderView($view, array $data = []){
            $content = $this->renderContent($view, $data);
            $layout = $this->renderLayout();
            
            return str_replace( "{{ content }}", $content, $layout);
        }

        protected function renderLayout(){
            ob_start();
            include_once(Application::$ROOT_DIR . "/views/layouts/main.php");
            return ob_get_clean();

        }

        protected function renderContent($content, $data){
            foreach($data as $key=>$value){
                $$key = $value;
            }
            ob_start();
            include_once(Application::$ROOT_DIR . "/views/". $content .".php");
            return ob_get_clean();
        }
    }



?>