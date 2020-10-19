<?php
   require_once('Model.php');
   /**
    * Models Agrovet store sales item
    */
    class AgrovetItem extends Model {
        public $name;
        public $category;
        public $description;
        public $quantity;
        public $agrovet_id;
        public $unit_price;
        public $added_on;
    }
?>