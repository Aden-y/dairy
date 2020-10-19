<?php
    class Database 
    { 
        /**
         * Creates and returns the connection object
         * @return PDO connection or null
         */
        private static function connect(): ? PDO {
            $db_name = 'dairy';
            $server_name = 'localhost';
            $user = 'root';
            $password = '';
            try {
                $conn = new PDO("mysql:host=$server_name;dbname=$db_name", $user, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
                }
            catch(PDOException $e)
                {
                    return null;
                }
        }
        
        /**
         * Returns a single associative array result from executed prepared query
         * @param sql the prepared sql
         * @param data the array of data to bind with the prepared sql query
         * @return row associative array from the database
         */
        public static function row(string $sql, array $data = []) {
            $stmt = Database::executePrepared($sql, $data, true);
            return $row = $stmt->fetch();
        }

         /**
         * Returns a multiple associative arrays result from executed prepared query
         * @param sql the prepared sql
         * @param data the array of data to bind with the prepared sql query
         * @return rows associative arrays from the database
         */
        public static function rows(string $sql, array $data = []) {
            $stmt = Database::executePrepared($sql, $data, true);
            return $rows = $stmt->fetchAll();
        }

        /**
         * Excecutes a prepared statement 
         * @param sql prepared sql statement
         * @param data array of data to bind to prepare statement
         * @param query whether or not this should be ececuted as  query or update
         */
        public static function executePrepared(string $sql, array $data = [], bool $query = false) {
            $conn = Database::connect();
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);
            if($query) {
                return $stmt;
            }else {
                $stmt = null;
            }
        }

        /**
         * Inserts data to the database and returns the last auto generated id.
         * @param sql the prepared sql statement
         * @param data the data to bind to the prepared statement
         * @return id the last inserted id
         */
        public static function lastId(string $sql, array $data= []){
            $conn = Database::connect();
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);
            $id = $conn->lastInsertId();
            $stmt = null;
            return $id+0;
        }

    }
    

?>