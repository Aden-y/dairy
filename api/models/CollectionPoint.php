<?php
   require_once('Model.php');
   /**
     * Models mill collection station object
     * 
     */
    class CollectionPoint  extends Model{
        public $county;
        public $subcounty;
        public $ward;
        public $name;
        public $status;
        public $unit_price;
        public $registered_on;
        public $attendant;
    }
?>