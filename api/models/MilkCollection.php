<?php
    require_once('Model.php');
    /**
     * Models MilkSubmission By A Farmer
     */
    class MilkCollection extends Model {
        public $point_id;
        public $quantity;
        public $received_by;
        public $unit_price;
        public $received_at;
        public $amount;
        public $farmer_id;
    }

?>