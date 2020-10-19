<?php
require_once '../repositories/UserRepository.php';
require_once '../repositories/CollectionPointRepository.php';
require_once '../repositories/MilkCollectionRepository.php';
require_once '../repositories/FarmerAccountTransactionLogRepository.php';
class AdminHomeService{
    public static function load() {
        $dashboard = [
            'farmers' => UsersRepository::numberOfFarmers(),
            'vets' => UsersRepository::numberOfVets(),
            'agrovets' => UsersRepository::numberOfAgrovets(),
            'employees' => UsersRepository::numberOfEmployees(),
            'collection_total' => MilkCollectionRepository::totalCollection(),
            'collection_amount' => MilkCollectionRepository::totalCollectionAmount(),
            'stations' => CollectionPointRepository::countStations(),
            'payout' => FarmerAccountTransactionLogRepository::totalPayouts()
        ];

        $collections = MilkCollectionRepository::findAll();
        $_collections = [];

        foreach ($collections as $c) {
            $station = CollectionPointRepository::get($c->point_id)->name;
            $farmer = UsersRepository::get($c->farmer_id);
            $attendant = UsersRepository::get($c->received_by);


            $_c = [
                'station' => $station,
                'farmer' =>$farmer->firstname. '  '.$farmer->lastname,
                'attendant'=>$attendant->firstname.' '.$attendant->lastname,
                'quantity' => $c->quantity,
                'amount'=> $c->amount,
                'price'=>$c->unit_price,
                'date'=>$c->received_at
            ];
            array_push($_collections, $_c);
        }

        return ['data'=>[
            'dashboard' => $dashboard,
            'collections' => $_collections
        ], 'status'=>200];
    }
}
