<?php 
  require_once('Repository.php');
  require_once('../models/FarmerAccountTransactionLog.php');
  /**
   * Data access for  FarmerAccountTransactionLog
   */
   class FarmerAccountTransactionLogRepository implements Repository {
    
    /**
     * Creates FarmerAccountTransactionLog object from the database row
     * @param row database row
     * @return FarmerAccountTransactionLog object
     */
    public static  function _get(array $row): FarmerAccountTransactionLog{
        $log = new FarmerAccountTransactionLog();
        $log->id = $row['id'];
        $log->description = $row['description'];
        $log->amount = $row['amount'];
        $log->date = $row['date'];
        $log->farmer_account_id = $row['farmer_account_id'];
        $log->type = $row['type'];
        return $log;
    }

    /**
     * Finds log with the id
     * @param id integer id of the log
     * @return FarmerAccountTransactionLog object or null
     */
    public static  function get(int $id): ? FarmerAccountTransactionLog{
        if($row = Database::row('select * from farmer_account_transaction_logs where id=?', [$id])) {
            return FarmerAccountTransactionLogRepository::_get($row);
        }
    }

    /**
     * Find all FarmerAccountTransactionLogs
     * @return array of FarmerAccountTransactionLogs
     */
    public static  function findAll() :array{
        $rows = Database::rows('select * from farmer_account_transaction_logs');
        $logs = [];
        foreach($rows as $row) {
            array_push($logs, FarmerAccountTransactionLogRepository::_get($row));
        }
        return $logs;
    }

    /**
     * Saves FarmerAccountTransactionLog Object to database
     * @param model FarmerAccountTransactionLog obect to save
     * @return FarmerAccountTransactionLog Object already saved with ID attribute set
     */
    public static  function save(Model $model): FarmerAccountTransactionLog{
        $sql = 'insert into farmer_account_transaction_logs (farmer_account_id, amount, type, description, date) values (?,?,?,?,?)';
        $data = [$model->farmer_account_id,  $model->amount, $model->type, $model->description, $model->date];
        $id = Database::lastId($sql, $data);
        $model->id = $id;
        return $model;
    }

    /**
     * Deletes the log with the specified id
     * @param id the id of the Storelog to delete
     */
    public static  function delete(int $id){
        Database::executePrepared('delete from farmer_account_transaction_logs where id=?', [$id]);
    }

    /**
     * Updates the details of the specified FarmerAccountTransactionLog object
     * @param model FarmerAccountTransactionLog  Object to update
     */
    public static  function update(Model $model){
        $sql = 'update farmer_account_transaction_logs set amount=?, type=?, description=?, date=? where id= ?';
        $data = [$model->amount,  $model->type, $model->description, $model->date, $model->id];
        Database::executePrepared($sql, $data);
    }

    /**
     * Finds FarmerAccountTransactionLog given FarmerAccountId
     * @param accountid integer FarmerAccount ID
     * @return array of FarmerAccountTransactionLog objects
     */
     public static function findByAccountId(int $accountid): array {
         $rows = Database::rows('select * from farmer_account_transaction_logs where farmer_account_id = ?', [$accountid]);
         $logs = [];
         foreach($rows as $row) {
             array_push($logs, FarmerAccountTransactionLogRepository::_get($row));
         }
         return $logs;
     }

     public static function totalPayouts() {
         if($row = Database::row('select sum(amount) as s  from farmer_account_transaction_logs where type=?', ['Credit'])) {
            return (double) $row['s'];
         }else{return 0;}
     }

  }

?>
