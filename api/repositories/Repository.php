<?php 
  include_once('../database/Database.php');
  include_once('../models/Model.php');
  /**
   * Data access/ data repository interface for the verious 
   * model classes
   * A repository must be implemented for each model class
   * Documentation of each method to be provided in the implementing classes
   */
  interface Repository {
    public static  function _get(array $row);
    public static  function get(int $id);
    public static  function findAll() :array;
    public static  function save(Model $model);
    public static  function delete(int $id);
    public static  function update(Model $model);
  }

?>