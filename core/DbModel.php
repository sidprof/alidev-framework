<?php 
    namespace app\core;
    

    abstract class DbModel extends Model {

        abstract static public function tableName() : string;
        abstract static public function attributes() : array;
        abstract static public function primaryKey() : string;

        public static function findBySql($sql){
            $objects = [];

            $result = self::connection()->query($sql);
            while($rows = $result->fetch_assoc()){
                $object = new static;
                foreach($rows as $key=>$value){
                    if(property_exists($object, $key)){
                        $object->$key = $value;
                    }
                }
                $objects[] = $object; 
            }
            
            return $objects;
        }

        public static function findByWhere(array $conditions){
            foreach($conditions as $key=>$value){
                $conditionPairs[] = $key . " = '" . $value ."'";
            }
            $msg = "SELECT * FROM " . static::tableName();
            $msg .= " WHERE " . join(" AND ",$conditionPairs);

            $objects = static::findBySql($msg);
            return array_shift($objects);
        }


        public function save(){
           
            $saniProperties = $this->sanitizeModelProperties();

            $msg = "INSERT INTO " . static::tableName() . "(";
            $msg .= join(", ", array_keys($saniProperties));
            $msg .= ")VALUES('";
            $msg .= join("', '", array_values($saniProperties));
            $msg .= "')";
            $result =1;//self::connection()->query($msg);
            if(!$result){
                die("model insertion failed!");
            }
            return $result;

        }

        public function sanitizeModelProperties(){
            $saniProperties = [];
            foreach(static::attributes() as $attribute){
                $saniProperties[$attribute] = $this->connection()->escape_string($this->$attribute);
            }
            return $saniProperties;
        }

        public static function connection(){
            return Application::$app->database->connection;
        }

    }





?>