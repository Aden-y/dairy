<?php
require_once('../repositories/OrderRepository.php');
require_once('../repositories/OrderItemRepository.php');
require_once('../repositories/AgrovetItemRepository.php');
require_once('../repositories/AgrovetStoreRepository.php');
require_once('../repositories/UserRepository.php');
require_once('../repositories/AddressRepository.php');
class OrderService {
    public static function create(array $data) {
        $order = new Order();
        $order->farmer_id = $_SESSION['id'];
        $order->made_on = date('Y-m-d H:i:s');
        $order->status = 'In-Process';
        $order = OrderRepository::save($order);
        foreach($data as $i) {
            if($item = AgrovetItemRepository::get($i->item_id)) {
                $order_item = new OrderItem();
                $order_item->item_id = $item->id;
                $order_item->order_id = $order->id;
                $order_item->quantity = $i->quantity;
                $order_item->unit_price = $item->unit_price;
                $order_item->amount = $order_item->quantity * $order_item->unit_price;
                $order_item->status = 'In-Process';
                OrderItemRepository::save($order_item);
            }
        }
        return ['message'=> 'Items ordered successfully. You will be contacted by the store owners', 'status'=>200];
    }

    public static function farmerOrders() {
        $orders = OrderRepository::findByFarmerId($_SESSION['id']);
        foreach($orders as $order) {
            $order_items = OrderItemRepository::findByOrderId($order->id);
            foreach($order_items as $order_item) {
                $item = AgrovetItemRepository::get($order_item->item_id);
                $order_item->name = $item->name;
                $order_item->category = $item->category;
                $order_item->description = $item->description;
                $store = AgrovetStoreRepository::get($item->agrovet_id);
                $order_item->store = $store->name;
            }
            $order->items = $order_items;
        }
        return ['status'=>200, 'orders'=> $orders];
    }

    public static function getStoreOrders(bool $all = false) {
        $store = AgrovetStoreRepository::findByOwnerId($_SESSION['id']);
        $order_items = $all ? OrderItemRepository::findAll() : OrderItemRepository::incomplete();
        $store_orders = [];
        foreach($order_items as $order_item) {
            $item = AgrovetItemRepository::get($order_item->item_id);
            if($item->agrovet_id == $store->id) {
                $order = OrderRepository::get($order_item->order_id);
                $farmer = UsersRepository::get($order->farmer_id);
                $order_item->name = $item->name;
                $order_item->category = $item->category;
                $order_item->description = $item->description;
                $order_item->farmer = ['name'=>$farmer->firstname.' '.$farmer->lastname, 
                'phone'=>$farmer->phone, 'email'=>$farmer->email, 'address'=>AddressRepository::findByUserId($farmer->id)];
                array_push($store_orders, $order_item);
            }
        }
        return ['status'=>200, 'orders'=>$store_orders];
    }
}
?>