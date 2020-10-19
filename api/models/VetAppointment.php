<?php
   require_once('Model.php');
    class VetAppointment extends Model {
        public $farmer_id;
        public $category;
        public $description;
        public $created_on;
        public $date;
        public $vet_id;
        public $status;
    }

?>