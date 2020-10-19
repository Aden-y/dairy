<?php
    require_once('Repository.php');
    require_once('../models/User.php');
    class UsersRepository implements Repository {

        /**
         * Creates a user from a database row
         * @param array associative array from database query
         * @return user User object
         */
        public static function _get(array $row) : User{
            $user = new User();
            $user->id =$row['id'];
            $user->firstname =$row['firstname'];
            $user->lastname =$row['lastname'];
            $user->email =$row['email'];
            $user->phone =$row['phone'];
            $user->national_id =$row['national_id'];
            $user->type =$row['type'];
            $user->registered_on =$row['registered_on'];
            $user->password =$row['password'];
            return $user;
        }

        /**
         * Gets user with the specified id
         * @param id user's id
         * @return user User Object
         */
        public static  function get(int $id): ? User{
            $sql = "select * from users where id = ?";
            $values = [$id];
            $row = Database::row($sql, $values);
            if($row) {
                return UsersRepository::_get($row);
            }else {
                return null;
            }
        }

        /**
         * Gets the user give the email
         * @param email the user email address
         * @return user User Object
         */
        public static  function findByEmail(string $email): ? User{
            $sql = "select * from users where email = ?";
            $values = [$email];
            $row =  Database::row($sql, $values);
            if($row) {
                return UsersRepository::_get($row);
            }
        }

        /**
         * Returns all users in the database
         * @return array user objcts 
         */
        public static function findAll() : array{
            $sql = "select * from users";
            $rows =  Database::rows($sql);
            $users = [];
            foreach($rows as $row) {
                array_push($users, UsersRepository::_get($row));
            }
            return $users;
        }

        /**
         * Determines if an email is already used
         * @param email the email address to check
         *
         * @return bool
         */
        public static  function emailTaken(string $email ) :  bool {
            if(Database::row('select id from users where email = ?', [$email])) {
                return true;
            }else {return false;}
        }

        /**
         * Determines whether the national id number is already in use.
         * @param id the national id to check
         * @return bool
         */
        public static function nationalIdUsed(int $id ): bool {
            if(Database::row('select id from users where national_id = ?', [$id])) {
                return true;
            }else {return false;}
        }

        /**
         * Saves the user to  the database
         * @param Model $user
         * @return user  user object with the ID attribute set
         */
        public static  function save(Model $user) : User{
            $sql = "insert into users (firstname, lastname, 
            email, phone, national_id, type, registered_on, password) values(?,?,?,?,?,?,?, ?)";
            $values = [
                $user->firstname,
                $user->lastname,
                $user->email,
                $user->phone,
                $user->national_id,
                $user->type,
                date('Y-m-d H:i:s'),
                password_hash($user->password, PASSWORD_DEFAULT)
            ];
            $id = Database::lastId($sql, $values);
            $user->id = $id;
            return $user;
        }

        /**
         * Deletes user with the given id 
         * @param integer the user id
         */
        public static  function delete(int $id) {

        }

        /**
         * Updates the user details
         * @param Model the user to update
         */
        public static function update(Model $user) {

        }

        public static function findByRole(string $role) {
            $sql = "select * from users where type=?";
            $rows =  Database::rows($sql, [$role]);
            $users = [];
            foreach($rows as $row) {
                array_push($users, UsersRepository::_get($row));
            }
            return $users;
        }

        public static function findById(int $id): ? User {
            if($row = Database::row('select * from users where national_id = ?', [$id])) {
                return  UsersRepository::_get($row);
            }else {return null;}  
        }

        /**
         *
         */
        public static  function  numberOfEmployees() {
            if($row = Database::row('select count(*) as c from users  where type = ?', ['Employee'])) {
                return (int)$row['c'];
            }else { return  0;}
        }

        public static  function  numberOfVets() {
            if($row = Database::row('select count(*) as c from users  where type = ?', ['Vet'])) {
                return (int)$row['c'];
            }else { return  0;}
        }

        public static  function  numberOfAgrovets() {
            if($row = Database::row('select count(*) as c from users  where type = ?', ['Agrovet'])) {
                return (int)$row['c'];
            }else { return  0;}
        }

        public static  function  numberOfFarmers() {
            if($row = Database::row('select count(*) as c from users  where type = ?', ['Farmer'])) {
                return (int)$row['c'];
            }else { return  0;}
        }
    }
?>
