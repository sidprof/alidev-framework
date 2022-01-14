<?php 

    require_once(__DIR__ . "/vendor/autoload.php");
    use app\core\Application;

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $config = [
        "db"=>[
            "dbHost"=>$_ENV["DB_HOST"],
            "dbUser"=>$_ENV["DB_USER"],
            "dbPassword"=>$_ENV["DB_PASSWORD"],
            "dbName"=>$_ENV["DB_NAME"],
        ]
        ];

    $app = new Application(__DIR__, $config);
    $app->database->applyMigrations();
    

    


?>