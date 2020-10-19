<?php 
  require_once('Repository.php');
  require_once('../models/OrderItem.php');
  /**
   * Data access for agrovet store items
   */
   class OrderItemRepository implements Repository {
    
    /**
     * Creates OrderItem object from the database row
     * @param row database row
     * @return OrderItem object
     */
    public static  function _get(array $row): OrderItem{
        $item = new OrderItem();
        $item->id = $row['id'];
        $item->order_id = $row['order_id'];
        $item->unit_price = $row['unit_price'];
        $item->quantity = $row['quantity'];
        $item->item_id = $row['item_id'];
        $item->status = $row['status'];
        $item->amount = $row['amount'];
        return $item;
    }

    /**
     * Finds item with the id
     * @param id integer id of the item
     * @return OrderItem object or null
     */
    public static  function get(int $id): ? OrderItem{
        if($row = Database::row('select * from order_items where id=?', [$id])) {
            return OrderItemRepository::_get($row);
        }
    }

    /**
     * Find all OrderItems
     * @return array of OrderItems
     */
    public static  function findAll() :array{
        $rows = Database::rows('select * from order_items');
        $items = [];
        foreach($rows as $row) {
            array_push($items, OrderItemRepository::_get($row));
        }
        return $items;
    }

    /**
     * Saves OrderItem Object to database
     * @param model OrderItem object to save
     * @return OrderItem Object already saved with ID attribute set
     */
    public static  function save(Model $model): OrderItem{
        $sql = 'insert into order_items (order_id, unit_price,  quantity, amount, item_id, status) values (?,?,?,?,?,?)';
        $data = [$model->order_id,  $model->unit_price, $model->quantity, $model->amount,  $model->item_id, $model->status];
        $id = Database::lastId($sql, $data);
        $model->id = $id;
        return $model;
    }

    /**
     * Deletes the item with the specified id
     * @param id the id of the StoreItem to delete
     */
    public static  function delete(int $id){
        Database::executePrepared('delete from order_items where id=?', [$id]);
    }

    /**
     * Updates the details of the specified OrderItem object
     * @param model OrderItem  Object to update
     */
    public static  function update(Model $model){
        $sql = 'update order_items set  unit_price=?,  quantity=?, amount=?, status=? where id=?';
        $data = [$model->unit_price,  $model->quantity, $model->amount, $model->status, $model->id];
        Database::executePrepared($sql, $data);
    }

    /**
     * Finds OrderItem given AgrovetItem ID
     * @param itemid integer AgrovetItem ID
     * @return array of OrderItem objects
     */
     public static function findByItemId(int $itemid): array {
         $rows = Database::rows('select * from order_items where item_id = ?', [$itemid]);
         $items = [];
         foreach($rows as $row) {
             array_push($items, OrderItemRepository::_get($row));
         }
         return $items;
     }

     /**
     * Finds OrderItem given Order ID
     * @param orderid integer Order ID
     * @return array of OrderItem objects
     */
    public static function findByOrderId(int $orderid): array {
        $rows = Database::rows('select * from order_items where order_id = ?', [$orderid]);
        $items = [];
        foreach($rows as $row) {
            array_push($items, OrderItemRepository::_get($row));
        }
        return $items;
    }

     /**
     * Finds OrderItem given Order ID
     * @param orderid integer Order ID
     * @return array of OrderItem objects
     */
    public static function incomplete(): array {
        $rows = Database::rows("select * from order_items where status not in ('Complete')");
        $items = [];
        foreach($rows as $row) {
            array_push($items, OrderItemRepository::_get($row));
        }
        return $items;
    }

    public static function countCompleteOrders($agrovet_id) {
        $sql = 'select count(*) as c from order_items oi INNER JOIN agrovet_items ai ON oi.item_id = ai.id WHERE ai.agrovet_id = ? AND oi.status = ?';
        if ($row = Database::row($sql,[$agrovet_id, 'Complete'])) {
            return $row['c'];
        }else{return 0;}
    }

       public static function countActiveOrders($agrovet_id) {
           $sql = 'select count(*) as c from order_items oi INNER JOIN agrovet_items ai ON oi.item_id = ai.id WHERE ai.agrovet_id = ? AND oi.status = ?';
           if ($row = Database::row($sql,[$agrovet_id, 'In-Process'])) {
               return $row['c'];
           }else{return 0;}
       }

       public static function countTotalOrders($agrovet_id) {
           $sql = 'select count(*) as c from order_items oi INNER JOIN agrovet_items ai ON oi.item_id = ai.id WHERE ai.agrovet_id = ?';
           if ($row = Database::row($sql,[$agrovet_id])) {
               return $row['c'];
           }else{return 0;}
       }

       public static function findByStoreId($storeid) {
           $sql = 'select oi.*  from order_items oi INNER JOIN agrovet_items ai ON oi.item_id = ai.id WHERE ai.agrovet_id = ?';
           $rows = Database::rows($sql, [$storeid]);
           $items = [];
           foreach($rows as $row) {
               array_push($items, OrderItemRepository::_get($row));
           }
           return $items;
       }

       public static function findActiveByStoreId($storeid) {
           $sql = 'select oi.*  from order_items oi INNER JOIN agrovet_items ai ON oi.item_id = ai.id WHERE ai.agrovet_id = ? AND  oi.status=?';
           $rows = Database::rows($sql, [$storeid, 'In-Process']);
           $items = [];
           foreach($rows as $row) {
               array_push($items, OrderItemRepository::_get($row));
           }
           return $items;
       }


  }
