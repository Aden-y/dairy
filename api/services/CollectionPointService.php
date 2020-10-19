<?php
    require_once('../repositories/CollectionPointRepository.php');
    require_once('../repositories/UserRepository.php');
    require_once '../repositories/MilkCollectionRepository.php';
    class CollectionPointService {
        /**
         * Creates a collection point from the given json data object and saves it
         * to the database
         * @param data json object
         * @return array associative array
         */
        public static function register(object $data) {
            $station = new CollectionPoint();
            $station->name = $data->name;
            $station->county = $data->county;
            $station->subcounty = $data->subcounty;
            $station->ward = $data->ward;
            $station->unit_price = $data->unit_price;
            $station->registered_on = date('Y-m-d H:i:s');
            $station->status = 'Closed';
            CollectionPointRepository::save($station);
            return ['message'=> 'Milk collection station successfully registered with operational status closed' , 'status'=>200];
        }

        /**
         * Gets the currently actively loged collection station
         * @return collectionpoint object
         */
         public static function activeStation() : ? CollectionPoint{
            return CollectionPointRepository::findByAttendantId($_SESSION['id']);
         }    
         
         /**
          * Returns Name and id of station only
          */

          public static function nameAndId() :array {
            $stations = CollectionPointRepository::findAll();
            $actual  = [];
            foreach($stations as $station) {
                array_push($actual, ['name'=>$station->name, 'id'=>$station->id]);
            }
            return ['status'=> 200, 'stations'=> $actual];
          }

          public static function allStations() : array {
            $stations = CollectionPointRepository::findAll();
            foreach($stations as $station) {
               if($station->attendant == null) {
                $station->attendant = '-';
               }else{
                $attendant = UsersRepository::get($station->attendant);
                $station->attendant = $attendant->firstname.' '.$attendant->lastname;
               }
               $station->total = MilkCollectionRepository::findStationTotals($station->id);
            }
            return ['status'=> 200, 'stations'=> $stations];
          }

          public static function publicView() {
            $actual = [];
            $stations = CollectionPointRepository::findAll();
            foreach($stations as $station) {
               if($station->attendant == null) {
                $contact = null;
               }else{
                $attendant = UsersRepository::get($station->attendant);
                $contact = $attendant->phone;
               }
               array_push($actual, [
                    'name'=>$station->name,
                    'county'=>$station->county,
                    'subcounty'=>$station->subcounty,
                    'ward'=>$station->ward,
                    'contact'=>$contact,
               ]);
            }
            return ['status'=> 200, 'stations'=> $actual];
          }
    }
?>
