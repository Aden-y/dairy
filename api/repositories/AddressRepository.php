<?php
require_once('Repository.php');
require_once('../models/Address.php');
require_once('../database/Database.php');
/**
 * Handles Address data access
 */
   class AddressRepository implements Repository {
     
    /**
     * Creates Address from database row
     * @param row database asscociative array
     * @return address Address object
     */
    public static  function _get(array $row): Address{
        $address = new Address();
        $address->county = $row['county'];
        $address->subcounty = $row['subcounty'];
        $address->ward = $row['ward'];
        $address->place = $row['place'];
        $address->user_id = $row['user_id'];
        return $address;
    }

    /**
     * Finds the address with the specified id
     * @param id id of the address
     * @return address Address object or null
     */
    public static  function get(int $id): ? Address {
        $sql = 'select * from addresses where id = ?';
        $row =  Database::row($sql, [$id]);
        if($row) {
            return AddressRepository::_get($row);
        }
    }

    /**
     * All Addresses
     * @return addresses array of Address objects
     */
    public static  function findAll() : array{
        $rows = Database::rows('select * from addresses');
        $addresses =  [];
        foreach($rows as $row) {
            array_push($addresses, AddressRepository::_get($row));
        }
    }

    /**
     * Saves the address to the database
     * @param model address object to save
     * @return model Address object from the parameter with id attribute set
     */
    public static  function save(Model $model) {
        $sql = 'insert into addresses (county, subcounty, ward, place, user_id) values(?,?,?,?,?)';
        $id = Database::lastId($sql, [$model->county, $model->subcounty, $model->ward, $model->place, $model->user_id]);
        $model->id = $id;
        return $model;
    }

    /**
     * Deletes the address with the specified id
     * @param id the address id
     * @return null
     */
    public static  function delete(int $id){
        $sql = 'delete from addresses where id = ?';
        Database::executePrepared($sql, [$id]);
    }

    /**
     * Updates the address
     * @param model the address to update
     */
    public static  function update(Model $model){
        $sql = 'update addresses set county = ?, subcounty=?, ward=?, place=? where id =?';
        Database::executePrepared($sql, [$model->county, $model->subcounty, $model->ward, $model->place, $model->id]);
    }

    /**
     * Finds the address given the user id
     * @param id the user's id
     * @return address the Address of the user
     */
    public static function findByUserId(int $userId) : ? Address {
        $sql = 'select * from addresses where user_id = ?';
        $row =  Database::row($sql, [$userId]);
        if($row) {
            return AddressRepository::_get($row);
        }
    }
   }
?>