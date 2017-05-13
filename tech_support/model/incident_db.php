<?php
class IncidentDB {
    public static function getnullIncidents() {
        $db = Database::getDB();
        $query = "SELECT * FROM incidents
                  INNER JOIN customers
                      ON incidents.customerID = customers.customerID
                  WHERE techID IS NULL";
        try{
              $statement = $db->prepare($query);
              $statement->execute();  
              $incidents = array();
              $result = $statement->fetch();
              while ($result != null){
                  $incident = new Incident($result['customerID'],
                                           $result['productCode'],
                                           $result['dateOpened'],
                                           $result['dateClosed'],
                                           $result['title'],
                                           $result['description']);
                  $incident->setincidentID($result['incidentID']);
                  $customer = CustomerDB::getCustomer($result['customerID']);
                  $customerName = $customer->getfullName();
                  $incident->setcustomerName($customerName);
                  $incidents[] = $incident;
                  $result = $statement->fetch();
              }
              $statement->closeCursor();    
              return $incidents;
        }catch (PDOException $e) {
              $error_message = $e->getMessage();
              display_db_error($error_message);
        }
    }

    public static function gettechIncidents() {
      $db = Database::getDB();
      $query = "SELECT techID, 
                (SELECT COUNT(*) FROM incidents 
                WHERE incidents.techID = technicians.techID) 
                AS incidentCount FROM technicians";
      try{
              $statement = $db->prepare($query);
              $statement->execute();  
              $technicians = array();
              $result = $statement->fetch();
              while ($result != null){
                  $technician = TechnicianDB::getTechnician($result['techID']);
                  $technician->setincidentCount($result['incidentCount']);
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

    public static function getIncident($incidentID) {
        $db = Database::getDB();
        $query = "SELECT * FROM incidents
                  WHERE incidentID = :incidentID";
        try{
              $statement = $db->prepare($query);  
              $statement->bindValue(':incidentID', $incidentID);
              $statement->execute(); 
              $result = $statement->fetch();
              $incident = new Incident($result['customerID'],
                                             $result['productCode'],
                                             $result['dateOpened'],
                                             $result['dateClosed'],
                                             $result['title'],
                                             $result['description']);
              $incident->setincidentID($result['incidentID']);
              $customer = CustomerDB::getCustomer($result['customerID']);
              $customerName = $customer->getfullName();
              $incident->setcustomerName($customerName);
              $statement->closeCursor();
              return $incident;
        }catch (PDOException $e) {
                $error_message = $e->getMessage();
                display_db_error($error_message);
        }
    }

    public static function assignIncident($incident) {
        $db = Database::getDB();
        $techID = $incident->gettechID();
        $incidentID = $incident->getincidentID();
        $query = "UPDATE incidents
                  SET techID = '$techID'
                  WHERE incidentID = :incidentID";
        try{
              $statement = $db->prepare($query);  
              $statement->bindValue(':incidentID', $incidentID);
              $statement->execute(); 
              $row_count = $statement->rowCount();
              $statement->closeCursor();
              return $row_count;
        }catch (PDOException $e) {
                $error_message = $e->getMessage();
                display_db_error($error_message);
        }

    }
    public static function getincidentsbyTech($techID) {
        $db = Database::getDB();
        $query = "SELECT * FROM incidents
                  INNER JOIN customers
                      ON incidents.customerID = customers.customerID
                  WHERE techID = :techID";
        try{
              $statement = $db->prepare($query);
              $statement->bindValue(':techID', $techID);
              $statement->execute();  
              $incidents = array();
              $result = $statement->fetch();
              while ($result != null){
                  $incident = new Incident($result['customerID'],
                                           $result['productCode'],
                                           $result['dateOpened'],
                                           $result['dateClosed'],
                                           $result['title'],
                                           $result['description']);
                  $incident->setincidentID($result['incidentID']);
                  $customer = CustomerDB::getCustomer($result['customerID']);
                  $customerName = $customer->getfullName();
                  $incident->setcustomerName($customerName);
                  $incidents[] = $incident;
                  $result = $statement->fetch();
              }
              $statement->closeCursor();    
              return $incidents;
        }catch (PDOException $e) {
              $error_message = $e->getMessage();
              display_db_error($error_message);
        }
    }
}
?>