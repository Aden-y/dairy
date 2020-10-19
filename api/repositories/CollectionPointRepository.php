<?php 
  require_once('Repository.php');
  require_once('../models/CollectionPoint.php');
  /**
   * Data access for CollectionPoint 
   */
   class CollectionPointRepository implements Repository {
    
    /**
     * Creates CollectionPoint object from the database row
     * @param row database row
     * @return CollectionPoint object
     */
    public static  function _get(array $row): CollectionPoint{
        $statiton = new CollectionPoint();
        $statiton->id = $row['id'];
        $statiton->name = $row['name'];
        $statiton->county = $row['county'];
        $statiton->subcounty = $row['subcounty'];
        $statiton->ward = $row['ward'];
        $statiton->unit_price = $row['unit_price'];
        $statiton->attendant = $row['attendant'];
        $statiton->status = $row['status'];
        $statiton->registered_on = $row['registered_on'];
        return $statiton;
    }

    /**
     * Finds statiton with the id
     * @param id integer id of the statiton
     * @return CollectionPoint object or null
     */
    public static  function get(int $id): ? CollectionPoint{
        if($row = Database::row('select * from collection_point where id=?', [$id])) {
            return CollectionPointRepository::_get($row);
        }else {return null;}
    }

    /**
     * Find all CollectionPoints
     * @return array of CollectionPoints
     */
    public static  function findAll() :array{
        $rows = Database::rows('select * from collection_point');
        $statitons = [];
        foreach($rows as $row) {
            array_push($statitons, CollectionPointRepository::_get($row));
        }
        return $statitons;
    }

    /**
     * Saves CollectionPoint Object to database
     * @param model CollectionPoint obect to save
     * @return CollectionPoint Object already saved with ID attribute set
     */
    public static  function save(Model $model): CollectionPoint{
        $sql = 'insert into collection_point (county, subcounty, ward, name, attendant, status, unit_price, registered_on) values (?,?,?,?,?,?,?,?)';
        $data = [$model->county,  $model->subcounty, $model->ward, $model->name, $model->attendant, $model->status, $model->unit_price,$model->registered_on, ];
        $id = Database::lastId($sql, $data);
        $model->id = $id;
        return $model;
    }

    /**
     * Deletes the statiton with the specified id
     * @param id the id of the Storestatiton to delete
     */
    public static  function delete(int $id){
        Database::executePrepared('delete from collection_point where id=?', [$id]);
    }

    /**
     * Updates the details of the specified CollectionPoint object
     * @param model CollectionPoint  Object to update
     */
    public static  function update(Model $model){
        $sql = 'update collection_point set county=?, subcounty=?, ward=?, name=?, attendant=?, status=?, unit_price=? where id= ?';
        $data = [$model->county,  $model->subcounty, $model->ward, $model->name, $model->attendant, $model->status, $model->unit_price, $model->id];
        Database::executePrepared($sql, $data);
    }

    /**
     * Finds CollectionPoint given attaendant id
     * @param attendantid integer attendantId ID
     * @return CollectionPoint  CollectionPoint objects
     */
     public static function findByAttendantId(int $attendantid): ? CollectionPoint {
         if($row = Database::row('select * from collection_point where attendant = ?', [$attendantid])) {
             return CollectionPointRepository::_get($row);
         }else {return null;}
     }

     public static function countStations() {
         if($row = Database::row('select count(*) as c from collection_point')) {
             return (int) $row['c'];
         }else{ return 0;}
     }

  }

?>
