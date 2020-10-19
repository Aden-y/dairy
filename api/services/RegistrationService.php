<?php
require_once('../repositories/UserRepository.php');
require_once('../repositories/AddressRepository.php');
require_once('../repositories/FarmerAccountRepository.php');
require_once('../repositories/AgrovetStoreRepository.php');
require_once('../repositories/VetDetailsRepository.php');
require_once('../repositories/CollectionPointRepository.php');
/**
 * Handles registrations
 */
class RegistrationService {
    /**
     * Creates and register new user from the request data
     * The method creates the accounts for the user depending on the role
     * @param data JSON Object containing registration details
     */
    public static function register(object $data) {
        $user = new User();
            $user->firstname = $data->firstname;
            $user->lastname = $data->lastname;
            $user->email = $data->email;
            $user->phone = $data->phone;
            $user->national_id = $data->national_id + 0;
            $user->type = $data->type;
            $user->password = $data->password;
        if(UsersRepository::nationalIdUsed($user->national_id)) {
            return ['error'=>'The national id is already used.', 'status' => 400];
        }else if(UsersRepository::emailTaken($user->email)) {
            return ['error'=>'The email is already used.', 'status' => 400];
        }else {
            $user = UsersRepository::save($user);
            $address = new Address();
            $address->county = $data->county;
            $address->subcounty = $data->subcounty;
            $address->ward = $data->county;
            $address->place = $data->place;
            $address->user_id = $user->id;
            AddressRepository::save($address);
            if($user->type == 'Farmer') {
                $account = new FarmerAccount();
                $account->farmer_id = $user->id;
                FarmerAccountRepository::save($account);
            }else if($user->type == 'Agrovet') {
                $store = new AgrovetStore();
                $store->name = $data->agrovet;
                $store->user_id = $user->id;
                $store->registered_on = $user->registered_on;
                AgrovetStoreRepository::save($store);
            }else if($user->type == 'Vet') {
                $details = new VetDetails();
                $details->user_id = $user->id;
                $details->specialization = $data->specialization;
                VetDetailsRepository::save($details);
            }else if($user->type == 'Employee') {
                $station = CollectionPointRepository::get($data->station_id);
                $station->attendant = $user->id;
                CollectionPointRepository::update($station);
            }
            return ['message'=> 'Registration successfull', 'status'=>200];  
        }
    }
}
?>