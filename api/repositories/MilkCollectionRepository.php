<?php 
  require_once('Repository.php');
  require_once('../models/MilkCollection.php');
  /**
   * Data access for agrovet store collections
   */
   class MilkCollectionRepository implements Repository {
    
    /**
     * Creates MilkCollection object from the database row
     * @param row database row
     * @return MilkCollection object
     */
    public static  function _get(array $row): MilkCollection{
        $collection = new MilkCollection();
        $collection->id = $row['id'];
        $collection->farmer_id = $row['farmer_id'];
        $collection->point_id = $row['point_id'];
        $collection->received_at = $row['received_at'];
        $collection->received_by = $row['received_by'];
        $collection->quantity = $row['quantity'];
        $collection->amount = $row['amount'];
        $collection->unit_price = $row['unit_price'];
        return $collection;
    }

    /**
     * Finds collection with the id
     * @param id integer id of the collection
     * @return MilkCollection object or null
     */
    public static  function get(int $id): ? MilkCollection{
        if($row = Database::row('select * from milk_collections where id=?', [$id])) {
            return MilkCollectionRepository::_get($row);
        }
    }

    /**
     * Find all MilkCollections
     * @return array of MilkCollections
     */
    public static  function findAll() :array{
        $rows = Database::rows('select * from milk_collections');
        $collections = [];
        foreach($rows as $row) {
            array_push($collections, MilkCollectionRepository::_get($row));
        }
        return $collections;
    }

    /**
     * Saves MilkCollection Object to database
     * @param model MilkCollection obect to save
     * @return MilkCollection Object already saved with ID attribute set
     */
    public static  function save(Model $model): MilkCollection{
        $sql = 'insert into milk_collections (farmer_id, point_id, received_at, received_by, quantity, unit_price, amount) values (?,?,?,?,?,?,?)';
        $data = [$model->farmer_id,  $model->point_id, $model->received_at, $model->received_by, $model->quantity, $model->unit_price, $model->amount];
        $id = Database::lastId($sql, $data);
        $model->id = $id;
        return $model;
    }

    /**
     * Deletes the collection with the specified id
     * @param id the id of the Storecollection to delete
     */
    public static  function delete(int $id){
        Database::executePrepared('delete from milk_collections where id=?', [$id]);
    }

    /**
     * Updates the details of the specified MilkCollection object
     * @param model MilkCollection  Object to update
     */
    public static  function update(Model $model){
        $sql = 'update milk_collections set  point_id=?, received_at=?, received_by=?, quantity=?, unit_price=?, amount=? where id= ?';
        $data = [$model->point_id, $model->received_at, $model->received_by, $model->quantity, $model->unit_price, $model->amount, $model->id];
        Database::executePrepared($sql, $data);
    }

    /**
     * Finds MilkCollection given station ID
     * @param int  CollectionPoint ID
     * @return array of MilkCollection objects
     */
     public static function findByStationId($stationid): array {
         $rows = Database::rows('select * from milk_collections where point_id = ?', [$stationid]);
         $collections = [];
         foreach($rows as $row) {
             array_push($collections, MilkCollectionRepository::_get($row));
         }
         return $collections;
     }

     /**
     * Finds MilkCollection given FarmerAccount ID
     * @param int   FarmerAccount ID
     * @return array of MilkCollection objects
     */
    public static function findByFarmerId(int $farmeraccountid): array {
        $rows = Database::rows('select * from milk_collections where farmer_id = ?', [$farmeraccountid]);
        $collections = [];
        foreach($rows as $row) {
            array_push($collections, MilkCollectionRepository::_get($row));
        }
        return $collections;
    }

    public static function totalCollection() {
        if($row = Database::row('select sum(quantity) as q from milk_collections')) {
            return (double) $row['q'];
        }else {return 0;}
    }

    public static function totalCollectionAmount() {
        if($row = Database::row('select sum(amount) as a from milk_collections')) {
            return (double)$row['a'];
        }else {return 0;}
    }

    public static function findStationTotals($id) {
        if ($row = Database::row('select sum(quantity) as c from milk_collections where point_id=?',[$id])) {
            return (double)$row['c'];
        }else{return 0.0;}
    }

    public static function stationCollectionToday($station_id) {
        if($row = Database::row('select sum(quantity) as q from milk_collections where point_id = ? AND received_at LIKE ?',  [$station_id, date('Y-m-d').'%'])){
            return $row['q'];
        }else{ return 0.0;}
    }



  }

?>
