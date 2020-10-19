<?php
require_once('Model.php');
  
/**
 * Models Monitary transaction involving farmer account
 */
    class FarmerAccountTransactionLog extends Model {
        public $farmer_account_id;
        public $amount;
        public $type;
        public $description;
        public $date;
    }

?>