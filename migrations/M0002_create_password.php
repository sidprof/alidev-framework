<?php 

    class M0002_create_password {
        public function up($connection){
            $msg = "ALTER TABLE users ";
            $msg .= "ADD COLUMN password VARCHAR(255) NOT NULL ";
            $msg .= "AFTER email ";

            $result = $connection->query($msg);
            if(!$result){
                die("migration creation failed!");
            }
            return $result;
        }

        public function down(){
            
        }
    }




?>