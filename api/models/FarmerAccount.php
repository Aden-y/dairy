<?php
    require_once('Model.php');
    class FarmerAccount extends Model {
        public $farmer_id;
        public $balance;
        public $divident;  
        public $transactions;      
    }


?>