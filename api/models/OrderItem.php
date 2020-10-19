<?php 
   require_once('Model.php');
   /**
    * Models each item in an order
    */
    class OrderItem extends Model {
        public $order_id;
        public $quantity;
        public $unit_price;
        public $amount;
        public $status;  
        public $item_id;  
    }
?>