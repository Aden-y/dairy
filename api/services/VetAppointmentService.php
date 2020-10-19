<?php
require_once('../repositories/VetAppointmentRepository.php');
require_once('../repositories/UserRepository.php');
class VetAppointmentService {
    public static function create(object $data) {
        $vet_id = $data->vet_id;
        if($vet = UsersRepository::get($vet_id) == null) {
            return ['error'=> 'Unkonwn vet', 'status'=>404];
        }else {
            $appointment = new VetAppointment();
            $appointment->category = $data->category;
            $appointment->description = $data->description;
            $appointment->date = $data->date;
            $appointment->vet_id = $data->vet_id;
            $appointment->created_on = date('Y-m-d H:i:s');
            $appointment->farmer_id =  $_SESSION['id'];
            $appointment->status = 'Pending';
            VetAppointmentRepository::save($appointment);
            return ['message'=> 'Appointment request sent successfully queued', 'status'=>200];
        }
       

    }

    public static function vetAppointments(int $id = 0) {
        if($id == 0) {
            $id = $_SESSION['id'];
        }

        $appointments = VetAppointmentRepository::findByVetId($id);
        foreach($appointments as $appointment) {
            $farmer = UsersRepository::get($appointment->farmer_id);
            $appointment->farmer = $farmer->firstname.' '.$farmer->lastname;
            $appointment->contact = $farmer->phone;
            $appointment->farmer_id = null;
        }
        return ['status'=>200, 'appointments'=>$appointments];
    }

    public static function farmerAppointments(int $id = 0) {
        if($id == 0) {
            $id = $_SESSION['id'];
        }

        $appointments = VetAppointmentRepository::findByFarmerId($id);
        foreach($appointments as $appointment) {
            $vet = UsersRepository::get($appointment->vet_id);
            $appointment->vet = $vet->firstname.' '.$vet->lastname;
            $appointment->contact = $vet->phone;
        }
        return ['status'=>200, 'appointments'=>$appointments];
    }

    public static function vetPendingAppointments() {

        $pending = [];
        $appointments = VetAppointmentService::vetAppointments()['appointments'];
        foreach($appointments as $appointment) {
           if($appointment->status == 'Pending') {
               array_push($pending, $appointment);
           }
        }
        return ['status'=>200, 'appointments'=>$pending];
    }


}


