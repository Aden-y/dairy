<?php
    session_start();
    /**
     * Middleware class
     */
    class Middleware {
        private static $FORBIDDEN = ['error'=> 'Forbidden', 'status'=>403];
        private static $UNAUTHENTICATED = ['error'=> 'Unauthenticated', 'status'=>401];
        /**
         * Sends forbidden access response to the client
         */
        private static function forbid(){
            http_response_code(403);
            echo json_encode(Middleware::$FORBIDDEN) ;
            exit();
        } 

         /**
         * Sends unauthenticated access response to the client
         */
        private static function unauthenticate(){
            http_response_code(401);
            echo json_encode(Middleware::$UNAUTHENTICATED) ;
            exit();
        }

        /**
         * Validates guest access
         */
        public static function guest() {
            if(isset($_SESSION['user'])) {
                Middleware::forbid();
            }
        }
        /**
         * Validates iauthenticated user access
         */
        public  static  function auth() {
            if(!isset($_SESSION['user'])) {
               Middleware::unauthenticate();
            }
        }

        /**
         * Validates employee role accesss
         */
        public static function employee() {
            Middleware::auth();
            if($_SESSION['role'] != 'Employee') {
               Middleware::forbid();
            }
        }

        /**
         * Validates farmer role access
         */
        public static function farmer() {
            Middleware::auth();
            if($_SESSION['role'] != 'Farmer') {
               Middleware::forbid();
            }
        }

        /**
         * Validates vet role access
         */
        public static function vet() {
            Middleware::auth();
            if($_SESSION['role'] != 'Vet') {
               Middleware::forbid();
            }
        }

        /**
         * Validates agrovet access
         */
        public static function agrovet() {
            Middleware::auth();
            if($_SESSION['role'] != 'Agrovet') {
               Middleware::forbid();
            }
        }

        /**
         * validates administrator access
         */
        public static function admin() {
            Middleware::auth();
            if($_SESSION['role'] != 'Admin') {
               Middleware::forbid();
            }
        }
    }
?>