<?php 
  require_once('Repository.php');
  require_once('../models/AgrovetItem.php');
  /**
   * Data access for agrovet store items
   */
   class AgrovetItemRepository implements Repository {
    
    /**
     * Creates AgrovetItem object from the database row
     * @param row database row
     * @return AgrovetItem object
     */
    public static  function _get(array $row): AgrovetItem{
        $item = new AgrovetItem();
        $item->id = $row['id'];
        $item->name = $row['name'];
        $item->category = $row['category'];
        $item->added_on = $row['added_on'];
        $item->quantity = $row['quantity'];
        $item->agrovet_id = $row['agrovet_id'];
        $item->description = $row['description'];
        $item->unit_price = $row['unit_price'];
        return $item;
    }

    /**
     * Finds item with the id
     * @param id integer id of the item
     * @return AgrovetItem object or null
     */
    public static  function get(int $id): ? AgrovetItem{
        if($row = Database::row('select * from agrovet_items where id=?', [$id])) {
            return AgrovetItemRepository::_get($row);
        }else {
            return null;
        }
    }

    /**
     * Find all AgrovetItems
     * @return array of AgrovetItems
     */
    public static  function findAll() :array{
        $rows = Database::rows('select * from agrovet_items');
        $items = [];
        foreach($rows as $row) {
            array_push($items, AgrovetItemRepository::_get($row));
        }
        return $items;
    }

    /**
     * Saves AgrovetItem Object to database
     * @param model AgrovetItem object to save
     * @return AgrovetItem Object already saved with ID attribute set
     */
    public static  function save(Model $model): AgrovetItem{
        $sql = 'insert into agrovet_items (name, category, description, quantity, agrovet_id, unit_price, added_on) values (?,?,?,?,?,?,?)';
        $data = [$model->name,  $model->category, $model->description, $model->quantity, $model->agrovet_id, $model->unit_price, $model->added_on];
        $id = Database::lastId($sql, $data);
        $model->id = $id;
        return $model;
    }

    /**
     * Deletes the item with the specified id
     * @param id the id of the StoreItem to delete
     */
    public static  function delete(int $id){
        Database::executePrepared('delete from agrovet_items where id=?', [$id]);
    }

    /**
     * Updates the details of the specified AgrovetItem object
     * @param model AgrovetItem  Object to update
     */
    public static  function update(Model $model){
        $sql = 'update agrovet_items set name=?, category=?, description=? , quantity =?, unit_price =? where id= ?';
        $data = [$model->name,  $model->category, $model->description, $model->quantity, $model->unit_price, $model->id];
        Database::executePrepared($sql, $data);
    }

    /**
     * Finds AgrovetItem given storeid
     * @param storeid integer AgrovetStore ID
     * @return array of AgrovetItem objects
     */
     public static function findByStoreId(int $storeid): array {
         $rows = Database::rows('select * from agrovet_items where agrovet_id = ?', [$storeid]);
         $items = [];
         foreach($rows as $row) {
             array_push($items, AgrovetItemRepository::_get($row));
         }
         return $items;
     }

     public static function countItemsInStore( $storeid) {
         if($row = Database::row('select count(*) as c from agrovet_items where agrovet_id = ?', [$storeid])){
             return $row['c'];
         }else {return 0;}
     }

  }
