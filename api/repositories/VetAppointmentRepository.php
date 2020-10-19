<?php 
  require_once('Repository.php');
  require_once('../models/VetAppointment.php');
  /**
   * Data access for agrovet store appointments
   */
   class VetAppointmentRepository implements Repository {
    /**
     * Creates VetAppointment object from the database row
     * @param array database row
     * @return VetAppointment object
     */
    public static  function _get(array $row): VetAppointment{
        $appointment = new VetAppointment();
        $appointment->id = $row['id'];
        $appointment->category = $row['category'];
        $appointment->farmer_id = $row['farmer_id'];
        $appointment->vet_id = $row['vet_id'];
        $appointment->created_on = $row['created_on'];
        $appointment->date = $row['date'];
        $appointment->status = $row['status'];
        $appointment->description = $row['description'];
        return $appointment;
    }

    /**
     * Finds appointment with the id
     * @param id integer id of the appointment
     * @return VetAppointment object or null
     */
    public static  function get(int $id): ? VetAppointment{
        if($row = Database::row('select * from vet_appointments where id=?', [$id])) {
            return VetAppointmentRepository::_get($row);
        }
    }

    /**
     * Find all VetAppointments
     * @return array of VetAppointments
     */
    public static  function findAll() :array{
        $rows = Database::rows('select * from vet_appointments');
        $appointments = [];
        foreach($rows as $row) {
            array_push($appointments, VetAppointmentRepository::_get($row));
        }
        return $appointments;
    }

    /**
     * Saves VetAppointment Object to database
     * @param model VetAppointment object to save
     * @return VetAppointment Object already saved with ID attribute set
     */
    public static  function save(Model $model): VetAppointment{
        $sql = 'insert into vet_appointments (farmer_id, category, description, created_on, date, status, vet_id) values (?,?,?,?,?,?,?)';
        $data = [$model->farmer_id,  $model->category, $model->description, $model->created_on, $model->date, $model->status, $model->vet_id];
        $id = Database::lastId($sql, $data);
        $model->id = $id;
        return $model;
    }

    /**
     * Deletes the appointment with the specified id
     * @param id the id of the Storeappointment to delete
     */
    public static  function delete(int $id){
        Database::executePrepared('delete from vet_appointments where id=?', [$id]);
    }

    /**
     * Updates the details of the specified VetAppointment object
     * @param model VetAppointment  Object to update
     */
    public static  function update(Model $model){
        $sql = 'update vet_appointments set category=?, description=?, date=?, status=?, vet_id=? where id= ?';
        $data = [$model->category,  $model->description, $model->date, $model->status, $model->vet_id, $model->id];
        Database::executePrepared($sql, $data);
    }

    /**
     * Finds VetAppointments given Farmers User ID
     * @param farmerid integer Farmers User ID
     * @return array of VetAppointment objects
     */
     public static function findByFarmerId(int $farmerid): array {
         $rows = Database::rows('select * from vet_appointments where farmer_id = ?', [$farmerid]);
         $appointments = [];
         foreach($rows as $row) {
             array_push($appointments, VetAppointmentRepository::_get($row));
         }
         return $appointments;
     }

      /**
     * Finds VetAppointments given Vet's User ID
     * @param int  Vet's User ID
     * @return array of VetAppointment objects
     */
    public static function findByVetId(int $vetid): array {
        $rows = Database::rows('select * from vet_appointments where vet_id = ?', [$vetid]);
        $appointments = [];
        foreach($rows as $row) {
            array_push($appointments, VetAppointmentRepository::_get($row));
        }
        return $appointments;
    }

    public static function findVetPendingAppointments($vetid) {
        $rows = Database::rows('select * from vet_appointments where vet_id = ? AND status =?', [$vetid, 'Pending']);
        $appointments = [];
        foreach($rows as $row) {
            array_push($appointments, VetAppointmentRepository::_get($row));
        }
        return $appointments;
    }

    public static function vetTotalAppointments($vetid) {
           if($row  = Database::row('select count(*) as c from vet_appointments where vet_id = ?', [$vetid])) {
               return $row['c'];
           }else{return 0;}
    }

       public static function vetPendingAppointments($vetid) {
           if($row  = Database::row('select count(*) as c from vet_appointments where vet_id = ? AND status = ?', [$vetid,'Pending'])) {
               return $row['c'];
           }else{return 0;}
       }


       public static function vetCompleteAppointments($vetid) {
           if($row  = Database::row('select count(*) as c from vet_appointments where vet_id = ? AND status = ?', [$vetid,'Complete'])) {
               return $row['c'];
           }else{return 0;}
       }
    
  }

