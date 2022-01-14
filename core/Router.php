<?php 
    namespace app\core;

    class Router{

        public array $middlewares = [];
        public array $routes = [];
        public Request $request;
        public Response $response;



        public function __construct(Request $request, Response $response){
            $this->request = $request;
            $this->response = $response;
        }
        public function get($path, $callback){
            $this->routes["get"][$path] = $callback;
            return $this;
        }

        public function post($path, $callback){
            $this->routes["post"][$path] = $callback;
            return $this;
        }



        public function resolve(){
            $path = $this->request->getPath();
            $method = $this->request->getMethod();

            $callback = $this->routes[$method][$path] ?? false;

            if(!$callback){
                throw new  exceptions\NotFoundException();
            }

            if(is_string($callback)){
                return $callback;
            }

            if(is_array($callback)){
                foreach($this->middlewares as $middleware){
                    $middleware->execute();
                }

                $controller = new $callback[0]();
                $callback[0] = $controller;
            }

            return call_user_func($callback, $this->request, $this->response);
        }

       

        public function registerMiddleware($middleware){
            $this->middlewares[] = $middleware;
        }

    }

?>