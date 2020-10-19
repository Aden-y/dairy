<?php
include_once('../repositories/UserRepository.php');
include_once('../repositories/FarmerAccountRepository.php');
include_once('../repositories/FarmerAccountTransactionLogRepository.php');
class LogService {
    public static function farmer() {
        $account = FarmerAccountRepository::findByFarmerId($_SESSION['id']);
        $logs = FarmerAccountTransactionLogRepository::findByAccountId($account->id);
        return ['status'=> 200, 'logs'=> $logs];
    }

    public static function admin() {
        $logs = FarmerAccountTransactionLogRepository::findAll();
        foreach($logs as $log) {
            $account = FarmerAccountRepository::get($log->farmer_account_id);
            $farmer = UsersRepository::get($account->farmer_id);
            $log->farmer = $farmer->firstname.''.$farmer->lastname;
            $log->farmer_account_id = null;
        }
        return ['status'=> 200, 'logs'=> $logs];
    }
}
?>