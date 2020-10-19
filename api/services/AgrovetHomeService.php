<?php
require_once '../repositories/AgrovetItemRepository.php';
require_once '../repositories/AgrovetStoreRepository.php';
require_once '../repositories/OrderItemRepository.php';
require_once '../repositories/UserRepository.php';
require_once '../repositories/OrderRepository.php';

class AgrovetHomeService {
    public static function load() {

        $agrovet = AgrovetStoreRepository::findByOwnerId($_SESSION['id']);
        $orders = OrderItemRepository::findActiveByStoreId($agrovet->id);
        $_orders = [];
        foreach ($orders as $o) {
            $item = AgrovetItemRepository::get($o->item_id);
            $farmer =UsersRepository::get(OrderRepository::get($o->order_id)->farmer_id);

            array_push($_orders, [
                'id'=>$o->id,
                'farmer_name'=>$farmer->firstname.' '.$farmer->lastname,
                'item'=>$item->name,
                'quantity'=>$o->quantity,
                'contact'=>$farmer->phone
            ]);
        }
        $data = [
            'items' =>AgrovetItemRepository::countItemsInStore($agrovet->id),
            'orders' =>OrderItemRepository::countTotalOrders($agrovet->id),
            'active'=>OrderItemRepository::countActiveOrders($agrovet->id),
            'complete'=>OrderItemRepository::countCompleteOrders($agrovet->id),
            'pending_orders'=>$_orders
        ];

        return ['data'=> $data, 'status'=>200];
    }

    public static function complete($id) {
        $order = OrderItemRepository::get($id);
        $order->status ='Complete';
        OrderItemRepository::update($order);
        return ['message'=>'Order marked as complete', 'status'=>200];
    }
}
