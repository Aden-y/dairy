<?php
require_once '../repositories/MilkCollectionRepository.php';
require_once '../repositories/CollectionPointRepository.php';
require_once '../repositories/UserRepository.php';
class EmployeeHomeService{
    public static function load() {
        $station = CollectionPointRepository::findByAttendantId($_SESSION['id']);
        $collections = MilkCollectionRepository::findByStationId($station->id);
        $_collections = [];

        foreach ($collections as $c) {
            array_push($_collections, [
                'quantity' =>$c->quantity,
                'farmer' => UsersRepository::get($c->farmer_id)->lastname.' '.UsersRepository::get($c->farmer_id)->firstname,
                'price'=>$c->unit_price,
                'amount'=>$c->amount,
                'date'=>$c->received_at
            ]);
        }
        $data = [
          'today' => MilkCollectionRepository::stationCollectionToday($station->id) ? : 0.0,
            'station' => $station->name,
            'total'=> MilkCollectionRepository::findStationTotals($station->id),
            'price'=>$station->unit_price,
            'collections' => $_collections
        ];
        return ['data'=>$data, 'status'=>200];
    }
}
