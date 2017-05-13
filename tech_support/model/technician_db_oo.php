<?php
class TechnicianDB {
    public static function getTechnicians() {
        $db = Database::getDB();
        $query = 'SELECT * FROM technicians';
        try{    
                $statement = $db->prepare($query);
                $statement->execute();
                $technicans = array();
                $result = $statement->fetch();
                while ($result != null){
                    $technician = new Technician($result['firstName'],
                                                 $result['lastName'],
                                                 $result['email'],
                                                 $result['phone'],
                                                 $result['password']);
                    $technician->settechID($result['techID']);
                    $technicians[] = $technician;
                    $result = $statement->fetch();
                }
                $statement->closeCursor();
                return $technicians;
        }catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }

    public static function getTechnician($techID) {
        $db = Database::getDB();
        $query = "SELECT * FROM technicians
                  WHERE techID = :techID";
        try{    
                $statement = $db->prepare($query);
                $statement->bindValue(':techID', $techID);
                $statement->execute(); 
                $result = $statement->fetch();
                $technician = new Technician($result['firstName'],
                                             $result['lastName'],
                                             $result['email'],
                                             $result['phone'],
                                             $result['password']);
                $technician->settechID($result['techID']);
                $statement->closeCursor();
                return $technician;
        }catch (PDOException $e) {
                $error_message = $e->getMessage();
                display_db_error($error_message);
        }
    }

    public static function deleteTechnician($techID) {
        $db = Database::getDB();
        $query = "DELETE FROM technicians
                  WHERE techID = :techID";
        try{    
                $statement = $db->prepare($query);
                $statement->bindValue(':techID', $techID);
                $statement->execute();
                $row_count = $statement->rowCount();
                $statement->closeCursor();
                return $row_count;
        }catch (PDOException $e) {
                $error_message = $e->getMessage();
                display_db_error($error_message);
        }
    }

    public static function addTechnician($technician) {
        $db = Database::getDB();

        $firstName = $technician->getfirstName();
        $lastName = $technician->getfirstName();
        $email = $technician->getEmail();
        $phone = $technician->getPhone();
        $password = $technician->getPassword();

        $query =
            "INSERT INTO technicians
                 (firstName, lastName, email, phone, password)
             VALUES
                 ('$firstName', '$lastName', '$email', '$phone', '$password')";
        try{
                $statement = $db->prepare($query);
                $statement->execute();
                $row_count = $statement->rowCount();
                $statement->closeCursor();
                return $row_count;
        }catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }

    public static function getTechnicianEmail($email) {
        $db = Database::getDB();
        $query = "SELECT * FROM technicians
                  WHERE email = :email";
        try{
              $statement = $db->prepare($query);
              $statement->bindValue(':email', $email);
              $statement->execute();
              $result = $statement->fetch();
              $technician = new Technician($result['firstName'],
                                             $result['lastName'],
                                             $result['email'],
                                             $result['phone'],
                                             $result['password']);
              $technician->settechID($result['techID']);
              $statement->closeCursor();
              return $technician;
        }catch (PDOException $e) {
                $error_message = $e->getMessage();
                display_db_error($error_message);
        }
    }
}
?>