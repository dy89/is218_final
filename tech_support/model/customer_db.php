<?php
class CustomerDB {
    public static function getCustomers($lastName) {
        $db = Database::getDB();
        $query = 'SELECT * FROM customers
                  WHERE lastName = :lastName';
        try{
              $statement = $db->prepare($query);
              $statement->bindValue(':lastName', $lastName);
              $statement->execute();
              $customers = array();
              $result = $statement->fetch();
              while ($result != null){
                    $customer = new Customer($result['firstName'],
                                             $result['lastName'],
                                             $result['address'],
                                             $result['city'],
                                             $result['state'],
                                             $result['postalCode'],
                                             $result['countryCode'],
                                             $result['phone'],
                                             $result['email'],
                                             $result['password']);
                    $customer->setcustomerID($result['customerID']);
                    $customers[] = $customer;
                    $result = $statement->fetch();
              }
              $statement->closeCursor();     
              return $customers;
            }catch (PDOException $e) {
              $error_message = $e->getMessage();
              display_db_error($error_message);
            }
    }

    public static function getCustomer($customerID) {
        $db = Database::getDB();
        $query = "SELECT * FROM customers
                  WHERE customerID = :customerID";
        try{
              $statement = $db->prepare($query);
              $statement->bindValue(':customerID', $customerID);
              $statement->execute();
              $result = $statement->fetch();
              $customer = new Customer($result['firstName'],
                                       $result['lastName'],
                                       $result['address'],
                                       $result['city'],
                                       $result['state'],
                                       $result['postalCode'],
                                       $result['countryCode'],
                                       $result['phone'],
                                       $result['email'],
                                       $result['password']);
              $customer->setcustomerID($result['customerID']);
              $statement->closeCursor();
              return $customer;
            }catch (PDOException $e) {
              $error_message = $e->getMessage();
              display_db_error($error_message);
            }
    }

    public static function getCustomerEmail($email) {
        $db = Database::getDB();
        $query = "SELECT * FROM customers
                  WHERE email = :email";
        try{
              $statement = $db->prepare($query);
              $statement->bindValue(':email', $email);
              $statement->execute();
              $result = $statement->fetch();
              $customer = new Customer($result['firstName'],
                                       $result['lastName'],
                                       $result['address'],
                                       $result['city'],
                                       $result['state'],
                                       $result['postalCode'],
                                       $result['countryCode'],
                                       $result['phone'],
                                       $result['email'],
                                       $result['password']);
              $customer->setcustomerID($result['customerID']);
              $statement->closeCursor();
              return $customer;
            }catch (PDOException $e) {
              $error_message = $e->getMessage();
              display_db_error($error_message);
            }
    }

    public static function updateCustomer($customer) {
        $db = Database::getDB();
        $customerID = $customer->getcustomerID();
        $firstName = $customer->getfirstName();
        $lastName = $customer->getlastName();
        $address = $customer->getAddress();
        $city = $customer->getCity();
        $state = $customer->getState();
        $postalCode = $customer->getpostalCode();
        $countryCode = $customer->getcountryCode();
        $phone = $customer->getPhone();
        $email = $customer->getEmail();
        $password = $customer->getPassword();

        $query = "UPDATE customers
                  SET firstName = '$firstName', lastName = '$lastName', address = '$address', 
                  city = '$city', state = '$state', postalCode = '$postalCode', countryCode = '$countryCode',
                  phone = '$phone', email = '$email', password = '$password'
                  WHERE customerID = :customerID";
        try{
              $statement = $db->prepare($query);
              $statement->bindValue(':customerID', $customerID);
              $statement->execute();
              $row_count = $statement->rowCount();
              $statement->closeCursor();
              return $row_count;
        }catch (PDOException $e) {
                $error_message = $e->getMessage();
                display_db_error($error_message);
        }

    }

    public static function getRegistrations($customerID) {
        $db = Database::getDB();
        $query = "SELECT * FROM registrations
                  INNER JOIN customers
                      ON registrations.customerID = customers.customerID
                  WHERE customers.customerID = :customerID";
        try{  
              $statement = $db->prepare($query);
              $statement->bindValue(':customerID', $customerID);
              $statement->execute();  
              $registrations = array();
              $result = $statement->fetch();
              while ($result != null){
                  $registration = new Registration($result['productCode'],
                                                   $result['registrationDate']);
                  $registration->setcustomerID($result['customerID']);
                  $product = ProductDB::getProduct($result['productCode']);
                  $productName = $product->getName();
                  $registration->setproductName($productName);
                  $registrations[] = $registration;
                  $result = $statement->fetch();
              }
              $statement->closeCursor();    
              return $registrations;
        }catch (PDOException $e) {
              $error_message = $e->getMessage();
              display_db_error($error_message);
        }
    }

    public static function addCustomer($customer) {
        $db = Database::getDB();
        $firstName = $customer->getfirstName();
        $lastName = $customer->getlastName();
        $address = $customer->getAddress();
        $city = $customer->getCity();
        $state = $customer->getState();
        $postalCode = $customer->getpostalCode();
        $countryCode = $customer->getcountryCode();
        $phone = $customer->getPhone();
        $email = $customer->getEmail();
        $password = $customer->getPassword();

        $query =
            "INSERT INTO customers
                 (firstName, lastName, address, city, state, postalCode, countryCode, phone, email, password)
             VALUES
                 ('$firstName', '$lastName', '$address', '$city', '$state', '$postalCode', '$countryCode', '$phone', '$email', '$password')";
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
}
?>