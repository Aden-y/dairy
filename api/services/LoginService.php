<?php
require_once('../repositories/UserRepository.php');
class LoginService {
    /**
     * Authenticates and crestes session for the legitimate user
     * @param data json data from containing login credentials
     */
    public static function login(object $data) {
        $user = UsersRepository::findByEmail($data->email);
        if(!$user) {
            return ['error'=> 'No such user.', 'status'=> 401];
        }else {
            if(!password_verify($data->password, $user->password)) {
                return ['error' => 'Incorrect password', 'status' => 401];
            }else {
                $time = microtime();
                $_SESSION['user'] = serialize($user);
                $_SESSION['name'] =  $user->firstname.' '.$user->lastname;
                $_SESSION['role'] = $user->type;
                $_SESSION['id'] = $user->id;
                $_SESSION['token'] = $time;
                return ['message' => 'Login success', 'status'=> 200, 'token' => password_hash($time, PASSWORD_DEFAULT)];
            }
        }
    }
}
?>