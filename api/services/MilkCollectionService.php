<?php
require_once('../repositories/MilkCollectionRepository.php');

require_once('UserService.php');
require_once('CollectionPointService.php');
require_once('FarmerAccountService.php');
/**
 * Handles Milk collections
 */
class MilkCollectionService {
/**
 * Receives milk colection
 * @param data json object containing milk quantity and farmer info
 * @return array associative array response
 */
    public static function receive($data) {
        if($farmer = UserService::findById($data->farmer_id)) {
           if($farmer->type == 'Farmer') {
            if($station = CollectionPointService::activeStation()) {
                $collection = new MilkCollection();
                $collection->farmer_id = $farmer->id;
                $collection->received_by = $_SESSION['id'];
                $collection->received_at = date('Y-m-d H:i:s');
                $collection->point_id = $station->id;
                $collection->unit_price = $station->unit_price;
                $collection->quantity = $data->quantity; 
                $collection->amount = $collection->unit_price * $collection->quantity;
                MilkCollectionRepository::save($collection);
                $description = 'Submission of '.$collection->quantity.' litres of milk to '.$station->name.' collection station at a price of Ksh.'.$collection->unit_price.' per litre';
                return FarmerAccountService::receive($collection->amount,$description, $farmer->id);
            }else{
                return ['error'=>'No valid collection station. Collection rejected.', 'status'=>404];
            }
           }else {
            return ['error'=>'Unknown farmer. Collection rejected.', 'status'=>404];
           }
        }else {
            return ['error'=>'Unknown farmer. Collection rejected.', 'status'=>404];
        }
    }
}

?>