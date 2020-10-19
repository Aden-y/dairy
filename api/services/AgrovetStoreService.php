<?php
include_once('../repositories/AgrovetStoreRepository.php');
include_once('../repositories/AgrovetItemRepository.php');
include_once('../repositories/UserRepository.php');
include_once('../repositories/AddressRepository.php');

class AgrovetStoreService {

    /**
     * Gets the store that is currently logged
     * @return AgrovetStore object
     */
    public static function activeStore(): ? AgrovetStore {
        return AgrovetStoreRepository::findByOwnerId($_SESSION['id']);
    }

    /**
     * Creates new agrovet item to the active store
     * @param data JSON object data
     * @return array response
     */
     public static function create(object $data) {
        $item = new AgrovetItem();
        $item->name = $data->name;
        $item->category = $data->category;
        $item->description = $data->description;
        $item->unit_price = $data->unit_price;
        $item->quantity = $data->quantity;
        $item->added_on = date('Y-m-d H:i:s');
        $item->agrovet_id = AgrovetStoreService::activeStore()->id;
        AgrovetItemRepository::save($item);
        return ['message' => 'Item created successfully', 'status'=>200];
     }

     public static function handle(object $data) {
         if($data->action == 'all') {
             return AgrovetStoreService::allItems();
         }else {
             return ['error'=>'Could not process request. Action unknown', 'status'=>404];
         }
     }

    /**
     * Returns agrovet items
     * 
     */
     public static function allItems() {
         $items = AgrovetItemRepository::findAll();
         foreach($items as $item) {
             $store = AgrovetStoreRepository::get($item->agrovet_id);
             $owner = UsersRepository::get($store->user_id);
             $owner->password = null;
             $owner->national_id = null;
             $address = AddressRepository::findByUserId($owner->id);
             $owner->id = null;
             $store->owner = $owner;
             $store->user_id = null;
             $store->id = null;
             $address->user_id = null;
             $store->address = $address;
             $item->store = $store;
             $item->agrovet_id = null;
         }
         return ['items'=>$items, 'status'=>200];
     }


}


?>