<?php

require_once('Repository.php');
require_once('../models/FarmerAccount.php');
require_once('../database/Database.php');
class FarmerAccountRepository implements Repository {
    /**
     * Creates an object of FarmerAccount from the given array
     * @param row associative array from the database select query
     * @return account FarmerAccount Object
     */
    public static  function _get(array $row): FarmerAccount{
        $account = new FarmerAccount();
        $account->id = $row['id'];
        $account->farmer_id = $row['farmer_id'];
        $account->balance = $row['balance'];
        $account->divident = $row['divident'];
        $account->farmer_id = $row['farmer_id'];
        return $account;
    }

    /**
     * Return an account for with the given id
     * @param id integer, account id
     * @return account FarmerAccount object
     */
    public static  function get(int $id): ? FarmerAccount{
        $sql = 'select * from farmer_account where id = ?';
        $row = Database::row($sql, [$id]);
        if($row) {
            return FarmerAccountRepository::_get($row);
        }
    }

    /**
     * Fetch all Farmer Accounts
     * @return accounts array of FarmerAccount objects
     */
    public static  function findAll(): array{
        $sql = 'select * from farmer_account';
        $rows = Database::rows($sql);
        $accounts = [];
        foreach($rows as $row) {
            array_push($accounts, FarmerAccountRepository::_get($row));
        }
        return $accounts;
    }

    /**
     * Savers the account details, initilly the balance and divident are 0.0
     * @param model FarmerAccount Object
     * @return model FarmerAccount Object after id attribute is set.
     */
    public static  function save(Model $model):FarmerAccount{
        $sql = 'insert into farmer_account(farmer_id) values(?)';
        $id = Database::lastId($sql, [$model->farmer_id]);
        $model->id = $id;
        return $model;
    }

    /**
     * Deletes the specified account
     * @param id integer id of the account to delete
     * @return null
     */
    public static  function delete(int $id){
        $sql = 'delete from farmer_account where id = ?';
        Database::executePrepared($sql, [$id]);
    }
    /**
     * Update s the balance and divident in the farmer accounts table, for the speciied acount object
     * @param model the FarmerAccount object to update.
     */
    public static  function update(Model $model){
        $sql = 'update farmer_account set balance=?, divident=?  where id=?';
        Database::executePrepared($sql, [$model->balance, $model->divident, $model->id]);
    }

    /**
     * Find the FarmerAccount for the specified farmer id
     * @param farmerid the id of the farmer
     * @return account FarmerAccount
     */

     public static function findByFarmerId(int $farmerid) : ? FarmerAccount{
        if($row = Database::row('select * from farmer_account where farmer_id =?', [$farmerid])) {
            return FarmerAccountRepository::_get($row);
        }
     }
}


?>