<?php 

class M0001_users {

    public function up($connection){
        $msg = "CREATE TABLE IF NOT EXISTS users (";
        $msg .= "id INT(11) AUTO_INCREMENT PRIMARY KEY,";
        $msg .= "firstname VARCHAR(255) NOT NULL,";
        $msg .= "lastname VARCHAR(255) NOT NULL,";
        $msg .= "email VARCHAR(255) NOT NULL,";
        $msg .= "status TINYINT(1) DEFAULT '0'";
        $msg .= ")";

        $result = $connection->query($msg);
        if(!$result){
            die("migration creation failed!");
        }
        return $result;
    }

    public function down(){
        echo "drop user table";
    }


}




?>