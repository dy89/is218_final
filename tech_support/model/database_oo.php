<?php
class Database {
    private static $dsn = 'mysql:host=sql1.njit.edu;dbname=dy89';
    private static $username = 'dy89';
    private static $password = 'dOYwhngu';
    private static $db;
    private static $options = array(PDO::ATTR_ERRMODE =>
                                    PDO::ERRMODE_EXCEPTION);
    
    private function __construct() {}

    public static function getDB () {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn,
                                     self::$username,
                                     self::$password);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                include('../errors/database_error.php');
                exit();
            }
        }
        return self::$db;
    }

    public function display_db_error($error_message){
        global $app_path;
        include '../errors/database_error.php';
        exit;
    }
}
?>