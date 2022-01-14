<?php 
    namespace app\core;

    class Database {
        public \mysqli $connection;

        public function __construct(array $config){
            $dbHost = $config['dbHost'];
            $dbUser = $config['dbUser'];
            $dbPassword = $config['dbPassword'];
            $dbName = $config['dbName'];

            $this->connection = new \mysqli($dbHost, $dbUser, $dbPassword, $dbName);
            if($this->connection->connect_errno){
                die("database connection failed!");
            }
        }

        public function applyMigrations(){
            $this->createMigrationTable();
            $migrationFiles = scandir(dirname(__DIR__). "/migrations");
            $appliedMigrations = $this->getAppliedMigrations();

            $applyMigrations = array_diff($migrationFiles, $appliedMigrations);
            foreach($applyMigrations as $value){
                if($value == "." || $value == ".."){
                    continue;
                }

                
                require_once(dirname(__DIR__) . "/migrations/" . $value);
                $className = basename($value, ".php");
                $migrationObject = new $className();

                echo $this->log($value . " migration starts");
                $migrationObject->up($this->connection);
                echo $this->log($value . " migrated successfully");

                $migrations[] = $value;
            }
            if(!empty($migrations)){
                $this->saveMigrationName($migrations);
            }else{
                echo $this->log("all migrations applied.");
            }

        }

        public function createMigrationTable(){
            $msg = "CREATE TABLE  IF NOT EXISTS migrations(";
            $msg .= "id INT(11) AUTO_INCREMENT PRIMARY KEY,";
            $msg .= "migration VARCHAR(255) NOT NULL,";
            $msg .= "created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
            $msg .=")";
            $result = $this->connection->query($msg);
            if(!$result){
                die("migrations table creation failed!");
            }
            return $result;
        }

        public function getAppliedMigrations(){
            $migrations = [];
            $msg = "SELECT migration FROM migrations";
            $result = $this->connection->query($msg);
            while($rows = $result->fetch_assoc()){
                $migrations[] = $rows['migration'];
            }
            return $migrations;
        }

        public function log($message){
            date_default_timezone_set("Africa/algiers");
            return "[" . date("Y-M-d H:i:s") . "] - " . $message . PHP_EOL;
        }

        public function saveMigrationName(array $migrations){
            foreach($migrations as $migration){
                $saniMigrations[] = $this->connection->escape_string($migration);
            }
            $msg =  "INSERT INTO migrations (";
            $msg .= "migration";
            $msg .= ") VALUES ('";
            $msg .= join("'),('", $saniMigrations);
            $msg .= "')";

            $result = $this->connection->query($msg);
            if(!$result){
                die("insert migration name failed!");
            }
            return $result;

        }
    }




?>