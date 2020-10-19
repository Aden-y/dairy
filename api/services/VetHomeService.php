<?php
include_once '../repositories/VetAppointmentRepository.php';
include_once '../repositories/UserRepository.php';

class VetHomeService {
    public static function load() {
        $requests = VetAppointmentRepository::findVetPendingAppointments($_SESSION['id']);
        $_requests = [];
        foreach($requests as $req) {
            $farmer = UsersRepository::get($req->farmer_id);
            array_push($_requests, [
                'farmer'=>$farmer->firstname.' '.$farmer->lastname,
                'contact'=> $farmer->phone,
                'category'=>$req->category,
                'description'=>$req->description,
                'id'=>$req->id
            ]);
        }
        $data = [
            'total' => VetAppointmentRepository::vetTotalAppointments($_SESSION['id']),
            'pending' => VetAppointmentRepository::vetPendingAppointments($_SESSION['id']),
            'complete' => VetAppointmentRepository::vetCompleteAppointments($_SESSION['id']),
            'requests'=>$_requests
        ];
        return ['data'=>$data, 'status'=>200];
    }

    public static function processFeedback($feedback) {
        $sql = 'insert into vet_feedbacks(appointment_id, problem, feedback) values(?,?,?)';
        $data = [$feedback->id, $feedback->problem, $feedback->feedback];
        Database::executePrepared($sql, $data);

        if($appointment = VetAppointmentRepository::get($feedback->id)) {
            $appointment->status = 'Complete';
            VetAppointmentRepository::update($appointment);
        }
    }
}
