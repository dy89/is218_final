<?php
class TechnicianDB {
    public static function getTechnicians() {
        $db = Database::getDB();
        $query = 'SELECT * FROM technicians';
        $result = $db->query($query);
        $technicans = array();
        foreach ($result as $row) {
            $technician = new Technician($row['firstName'],
                                   $row['lastName'],
                                   $row['email'],
                                   $row['phone'],
                                   $row['password']);
            $technician->settechID($row['techID']);
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
        $technician = new Technician($row['firstName'],
                                   $row['lastName'],
                                   $row['email'],
                                   $row['phone'],
                                   $row['password']);
        $technician->settechID($row['techID']);
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

        $row_count = $db->exec($query);
        return $row_count;
    }
}
?>