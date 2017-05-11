<?php
class TechnicianDB {
    public static function getTechnicians() {
        $db = Database::getDB();
        $query = 'SELECT * FROM technicians';
        $result = $db->query($query);
        $technicans = array();
        foreach ($result as $row) {
            $technician = new Technician($row['techID'],
                                   $row['firstName'],
                                   $row['lastName'],
                                   $row['email'],
                                   $row['phone'],
                                   $row['password']);
            $technicians[] = $technician;
        }
        return $technicians;
    }

    public static function getTechnician($techID) {
        $db = Database::getDB();
        $query = "SELECT * FROM technicians
                  WHERE techID = '$techID'";
        $result = $db->query($query);
        $row = $result->fetch();
        $technician = new Technician($row['techID'],
                                   $row['firstName'],
                                   $row['lastName'],
                                   $row['email'],
                                   $row['phone'],
                                   $row['password']);
        return $technician;
    }

    public static function deleteTechnician($techID) {
        $db = Database::getDB();
        $query = "DELETE FROM technicians
                  WHERE techID = '$techID'";
        $row_count = $db->exec($query);
        return $row_count;
    }

    public static function addTechnician($technician) {
        $db = Database::getDB();

        $techID = $technician->gettechID();
        $firstName = $technician->getfirstName();
        $lastName = $technician->getfirstName();
        $email = $technician->getEmail();
        $phone = $technician->getPhone();
        $password = $technician->getPassword();

        $query =
            "INSERT INTO technicians
                 (techID, firstName, lastName, email, phone, password)
             VALUES
                 ('$techID', '$firstName', '$lastName', '$email', '$phone', '$password')";

        $row_count = $db->exec($query);
        return $row_count;
    }
}
?>