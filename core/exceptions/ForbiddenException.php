<?php 
    namespace app\core\exceptions;

    class ForbiddenException extends \Exception {

        protected $message = "Sorry, you are not allowed to access this page.";
        protected $code = 403;
        
    }



?>