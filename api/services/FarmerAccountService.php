<?php 
require_once('../repositories/FarmerAccountRepository.php');
require_once('../repositories/FarmerAccountTransactionLogRepository.php');
require_once('../repositories/MilkCollectionRepository.php');
require_once('../repositories/CollectionPointRepository.php');
require_once('../repositories/UserRepository.php');
class FarmerAccountService {

/**
 * Records a credit transaction to the farmer's acount
 */
    public static function receive(float $amount, string $description, int $farmer_id) {
        if($account = FarmerAccountRepository::findByFarmerId($farmer_id)) {
            $account->balance = $account->balance + $amount;
            FarmerAccountRepository::update($account);
            $log = new FarmerAccountTransactionLog();
            $log->type = 'Credit';
            $log->farmer_account_id = $account->id;
            $log->amount = $amount;
            $log->description = $description;
            $log->date = date('Y-m-d H:i:s');
            FarmerAccountTransactionLogRepository::save($log);
            return ['message'=> 'Milk collection received successfully.', 'status'=>200];
        }else {
            return ['error'=> 'The farmer doesnt  have a valid account', 'status'=> 404];
        }
    }

    public static function myLogs() {
        $account = FarmerAccountRepository::findByFarmerId($_SESSION['id']);
        return  FarmerAccountService::logs($account->id);
    }



    public static function logs(int $account_id) {
         $logs = FarmerAccountTransactionLogRepository::findByAccountId($account_id);
         return ['status'=> 200, 'logs'=> $logs];
    }

    public static function myAccount() {
        return FarmerAccountService::account($_SESSION['id']);
    }

    public static function account(int $user_id) {
        $account = FarmerAccountRepository::findByFarmerId($user_id);
        $details = [
            'balance'=> $account->balance,
            'divident'=>$account->divident,
            'earnings'=>FarmerAccountService::totalEarnings($account->id),
            'submission'=>FarmerAccountService::totalSubmission($user_id),
            
        ];
        return ['status'=>200, 'details'=>$details];
    }


    public static function totalEarnings(int $account_id) {
        $logs = FarmerAccountService::logs($account_id)['logs'];
        $amount = 0.0;
        foreach($logs as $log) {
            if($log->type == 'Credit') {
                $amount+=$log->amount;
            }
        }
        return $amount;
    }

    public static function totalSubmission(int $farmer_id) {
        $submissions = MilkCollectionRepository::findByFarmerId($farmer_id);
        $total = 0.0;
        foreach($submissions as $submission) {
            $total+=$submission->quantity;
        }
        return $total;
    } 

    public static function mySubmissions()
    {
        return FarmerAccountService::submissions($_SESSION['id']);
    }

    public static function submissions(int $farmer_id) {
        $submissions = MilkCollectionRepository::findByFarmerId($farmer_id);
        $actual = [];
        foreach($submissions as $submission) {
            $station = CollectionPointRepository::get($submission->point_id);
            $attendant =UsersRepository::get($station->attendant);
            array_push($actual, [
                'station'=> [
                    'name' => $station->name,
                    'address'=>[
                        'county'=>$station->county,
                        'subconty'=>$station->subcounty,
                        'ward'=>$station->ward,
                    ]
                    ],
                    'unit_price'=> $submission->unit_price,
                    'received_by'=>$attendant->firstname.' '.$attendant->lastname,
                    'date'=>$submission->received_at,
                    'amount'=>$submission->amount,
                    'quantity'=>$submission->quantity
               
            ]);
        } 
        return ['status'=>200, 'submissions'=>$actual];
    }


    public static function handle(object $data) {
        $action = $data->action;
        if($action == 'details') {
            return FarmerAccountService::myAccount();
        }else if($action == 'logs') {
            return FarmerAccountService::myLogs();
        }else if($action == 'submissions') {
            return FarmerAccountService::mySubmissions();
        }else {
            return ['status'=>404, 'error'=> 'Unknown action'];
        }
    }
    
}

?>