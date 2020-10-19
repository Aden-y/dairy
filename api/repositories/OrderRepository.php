<?php 
  require_once('Repository.php');
  require_once('../models/Order.php');
  /**
   * Data access for  orders
   */
   class OrderRepository implements Repository {
    
    /**
     * Creates Order object from the database row
     * @param row database row
     * @return Order object
     */
    public static  function _get(array $row): Order{
        $order = new Order();
        $order->id = $row['id'];
        $order->farmer_id = $row['farmer_id'];
        $order->status = $row['status'];
        $order->made_on = $row['made_on'];
        return $order;
    }

    /**
     * Finds order with the id
     * @param id integer id of the order
     * @return Order object or null
     */
    public static  function get(int $id): ? Order{
        if($row = Database::row('select * from orders where id=?', [$id])) {
            return OrderRepository::_get($row);
        }
    }

    /**
     * Find all Orders
     * @return array of Orders
     */
    public static  function findAll() :array{
        $rows = Database::rows('select * from orders');
        $orders = [];
        foreach($rows as $row) {
            array_push($orders, OrderRepository::_get($row));
        }
        return $orders;
    }

    /**
     * Saves Order Object to database
     * @param model Order Object to save
     * @return Order Object already saved with ID attribute set
     */
    public static  function save(Model $model): Order{
        $sql = 'insert into orders (farmer_id, made_on, status) values (?,?,?)';
        $data = [$model->farmer_id,  $model->made_on, $model->status];
        $id = Database::lastId($sql, $data);
        $model->id = $id;
        return $model;
    }

    /**
     * Deletes the order with the specified id
     * @param id the id of the  order to delete
     */
    public static  function delete(int $id){
        Database::executePrepared('delete from orders where id=?', [$id]);
    }

    /**
     * Updates the details of the specified Order object
     * @param model Order  Object to update
     */
    public static  function update(Model $model){
        $sql = 'update orders set  status=? where id= ?';
        $data = [$model->status, $model->id];
        Database::executePrepared($sql, $data);
    }
   
     /**
     * Finds Order given Farmer ID
     * @param farmerid integer Faemer  ID
     * @return array of Order objects
     */
    public static function findByFarmerId(int $farmerid): array {
        $rows = Database::rows('select * from orders where farmer_id = ?', [$farmerid]);
        $orders = [];
        foreach($rows as $row) {
            array_push($orders, OrderRepository::_get($row));
        }
        return $orders;
    }

  }

?>