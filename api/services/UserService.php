<?php
    require_once('../repositories/UserRepository.php');
    require_once('../repositories/VetDetailsRepository.php');
    require_once('../repositories/AddressRepository.php');
    require_once('../repositories/CollectionPointRepository.php');
    require_once('../repositories/AgrovetStoreRepository.php');
    class UserService {
        /**
         * Gets authenticated user
         * @return User object or null
         */
        public static function authUser() : ? User {
            return UsersRepository::get($_SESSION['id']);
        }

         /**
         * Gets  user with the given userid
         * @param id UserID
         * @return User object or null
         */
        public static function get(int $id): ? User {
            return UsersRepository::get($id);
        }

        public static function findById(int $id) : ? User {
            return UsersRepository::findById($id);
        }

        public static function allVets() {
            $vets = UsersRepository::findByRole('Vet');
            $actual = [];
            foreach($vets as $vet) {
                $details = VetDetailsRepository::findByVetId($vet->id);
                array_push($actual, 
                [
                    'name' => $vet->firstname.' '.$vet->lastname,
                    'phone'=> $vet->phone,
                    'id'=> $vet->id,
                    'email'=>$vet->email,
                    'address'=> AddressRepository::findByUserId($vet->id),
                    'specialization' => $details->specialization,
                    'verified'=>$details->verified
                ]
            );
            }
            return ['status'=> 200, 'vets'=> $actual];
        }

        public static function getUsers(string $role): array {
            $users = UsersRepository::findByRole($role);
            
            foreach($users as $user) {
                $type = $user->type;
                $user->address = AddressRepository::findByUserId($user->id);
                if($type == 'Vet') {
                    $details = VetDetailsRepository::findByVetId($user->id);
                    $user->specialization = $details->specialization;
                    $user->verified = $details->verified;
                }else if($type == 'Agrovet') {
                    $store = AgrovetStoreRepository::findByOwnerId($user->id);
                    $user->store = $store->name;
                    $user->verified = $store->verified;
                }else if($type == 'Employee') {
                    $station = CollectionPointRepository::findByAttendantId($user->id);
                    $station == null ? $user->station = '-': $user->station = $station->name;
                }
            }

            return ['status'=> 200, 'users'=> $users];
        }

        public static function allAdmins() {
            
        }

        public static function allEmployees() {
            
        }

        public static function allAgrovets() {
            
        }
        
    }
?>