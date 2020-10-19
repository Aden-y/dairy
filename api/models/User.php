<?php

    include_once('Model.php');
     class User extends Model{
        public $firstname;
        public $lastname;
        public $email;
        public $phone;
        public $national_id;
        public $type;
        public $password;
        public $registered_on;

    }

?>