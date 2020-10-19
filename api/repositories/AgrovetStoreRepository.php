<?php

require_once('Repository.php');
require_once('../models/AgrovetStore.php');
require_once('../database/Database.php');
class AgrovetStoreRepository implements Repository {
    /**
     * Creates an object of AgrovetStore from the given array
     * @param row associative array from the database select query
     * @return store AgrovetStore Object
     */
    public static  function _get(array $row): AgrovetStore{
        $store = new AgrovetStore();
        $store->id = $row['id'];
        $store->user_id = $row['user_id'];
        $store->name = $row['name'];
        $store->verified = $row['verified'];
        return $store;
    }

    /**
     * Return an AgrovetStore for with the given id
     * @param id integer, store id
     * @return store AgrovetStore object
     */
    public static  function get(int $id): ? AgrovetStore{
        $sql = 'select * from agrovets where id = ?';
        $row = Database::row($sql, [$id]);
        if($row) {
            return AgrovetStoreRepository::_get($row);
        }else {
            return null;
        }
    }

    /**
     * Fetch all AgrovetStores
     * @return stores array of AgrovetStore objects
     */
    public static  function findAll(): array{
        $sql = 'select * from agrovets';
        $rows = Database::rows($sql);
        $stores = [];
        foreach($rows as $row) {
            array_push($stores, AgrovetStoreRepository::_get($row));
        }
        return $stores;
    }

    /**
     * Saves the AgrovetStore Object to the database
     * @param model AgrovetStore Object
     * @return model AgrovetStore Object after id attribute is set.
     */
    public static  function save(Model $model):AgrovetStore{
        $sql = 'insert into agrovets(user_id, name) values(?,?)';
        $id = Database::lastId($sql, [$model->user_id, $model->name]);
        $model->id = $id;
        return $model;
    }

    /**
     * Deletes the specified store
     * @param id integer id of the store to delete
     * @return null
     */
    public static  function delete(int $id){
        $sql = 'delete from agrovets where id = ?';
        Database::executePrepared($sql, [$id]);
    }
    /**
     * Updates  the store details (name, verified)
     * @param model the AgrovetStore object to update.
     */
    public static  function update(Model $model){
        $sql = 'update agrovets set name=?, verified=?  where id=?';
        Database::executePrepared($sql, [$model->name, $model->verified, $model->id]);
    }

    /**
     * Find the AgrovetStore for the specified agrovet owner id
     * @param ownerid the id of the farmer
     * @return store AgrovetStore
     */

     public static function findByOwnerId(int $ownerid) : ? AgrovetStore{
        if($row = Database::row('select * from agrovets where user_id =?', [$ownerid])) {
            return AgrovetStoreRepository::_get($row);
        }else {
            return null;
        }
     }
}


?>