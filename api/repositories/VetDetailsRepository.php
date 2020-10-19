<?php

require_once('Repository.php');
require_once('../models/VetDetails.php');
require_once('../database/Database.php');
class VetDetailsRepository implements Repository {
    /**
     * Creates an object of VetDetails from the given array
     * @param row associative array from the database select query
     * @return details VetDetails Object
     */
    public static  function _get(array $row) : VetDetails{
        $details = new VetDetails();
        $details->id = $row['id']+0;
        $details->user_id = $row['user_id'];
        $details->specialization = $row['specialization'];
        $details->verified = $row['verified'];
        return $details;
    }

    /**
     * Return an VetDetails for with the given id
     * @param id integer, details id
     * @return details VetDetails object
     */
    public static  function get(int $id): ? VetDetails{
        $sql = 'select * from vets where id = ?';
        $row = Database::row($sql, [$id]);
        if($row) {
            return VetDetailsRepository::_get($row);
        }
    }

    /**
     * Fetch all VetDetails
     * @return detailss array of VetDetails objects
     */
    public static  function findAll(): array{
        $sql = 'select * from vets';
        $rows = Database::rows($sql);
        $details = [];
        foreach($rows as $row) {
            array_push($details, VetDetailsRepository::_get($row));
        }
        return $details;
    }

    /**
     * Saves the VetDetails, the details are initially unverified
     * @param model VetDetails Object
     * @return model VetDetails Object after id attribute is set.
     */
    public static  function save(Model $model): VetDetails{
        $sql = 'insert into vets(user_id, specialization) values(?, ?)';
        $id = Database::lastId($sql, [$model->user_id, $model->specialization]);
        $model->id = $id;
        return $model;
    }

    /**
     * Deletes the specified vetDetails
     * @param id integer id of the details to delete
     * @return null
     */
    public static  function delete(int $id){
        $sql = 'delete from vets where id = ?';
        Database::executePrepared($sql, [$id]);
    }
    /**
     * Updates the specialization and verified in the vets table, for the speciied  object
     * @param model the VetDetails object to update.
     */
    public static  function update(Model $model){
        $sql = 'update vets set specialization=?, verified=?  where id=?';
        Database::executePrepared($sql, [$model->specialization, $model->verified, $model->id]);
    }

    /**
     * Finds the Vet details given the vet's userid
     * @param vetid The userId of the vet
     * @return VetDetails objects or null
     */

     public static function findByVetId(int $vetid) : ? VetDetails {
        $sql = 'select * from vets where user_id = ?';
        if($row = Database::row($sql, [$vetid])) {
            return VetDetailsRepository::_get($row);
        }
     }
}


?>