<?php 

    require_once(__DIR__ . "/../vendor/autoload.php");
    use app\core\Application;
    use app\core\middlewares\AuthMiddleware;
    use app\controllers\SiteController;
    use app\controllers\AuthController;

    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
    $dotenv->load();

    $config = [
        "db"=>[
            "dbHost"=>$_ENV["DB_HOST"],
            "dbUser"=>$_ENV["DB_USER"],
            "dbPassword"=>$_ENV["DB_PASSWORD"],
            "dbName"=>$_ENV["DB_NAME"],
        ]
        ];

    $rootDir = dirname(__DIR__);
    $app = new Application($rootDir, $config);

    $app->router->get("/", [SiteController::class, "home"]);

    $app->router->get("/register", [AuthController::class, "register"]);
    $app->router->post("/register", [AuthController::class, "register"]);

    $app->router->get("/login", [AuthController::class, "login"]);
    $app->router->post("/login", [AuthController::class, "login"]);

    $app->router->get("/logout", [AuthController::class, "logout"]);
    
    $app->router->get("/contact", [SiteController::class, "contact"]);
    $app->router->post("/contact", [SiteController::class, "contact"]);

    $app->router->get("/profile", [SiteController::class, "profile"])->registerMiddleware(new AuthMiddleware(["/profile"]));


    $app->run();


?>