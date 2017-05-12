<?php
class CustomerDB {
    public static function getCustomers($lastName) {
        $db = Database::getDB();
        $query = "SELECT * FROM customers
                  WHERE lastName = '$lastName'";
        try{
            $result = $db->query($query);
            $customers = array();
            foreach ($result as $row) {
                $customer = new Customer($row['firstName'],
                                      $row['lastName'],
                                      $row['address'],
                                      $row['city'],
                                      $row['state'],
                                      $row['postalCode'],
                                      $row['countryCode'],
                                      $row['phone'],
                                      $row['email'],
                                      $row['password']);
                $customer->setcustomerID($row['customerID']);
                $customers[] = $customer;
            }
            return $customers;
          }catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
          }
    }

    public static function getCustomer($customerID) {
        $db = Database::getDB();
        $query = "SELECT * FROM customers
                  WHERE customerID = '$customerID'";
    try{
        $result = $db->query($query);
        $row = $result->fetch();
        $customer = new Customer($row['firstName'],
                                   $row['lastName'],
                                   $row['address'],
                                   $row['city'],
                                   $row['state'],
                                   $row['postalCode'],
                                   $row['countryCode'],
                                   $row['phone'],
                                   $row['email'],
                                   $row['password']);
        $customer->setcustomerID($row['customerID']);
        return $customer;
    }catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
      }
    }

    public static function getCustomerEmail($email) {
        $db = Database::getDB();
        $query = "SELECT * FROM customers
                  WHERE email = '$email'";
    try{
        $result = $db->query($query);
        $row = $result->fetch();
        $customer = new Customer($row['firstName'],
                                   $row['lastName'],
                                   $row['address'],
                                   $row['city'],
                                   $row['state'],
                                   $row['postalCode'],
                                   $row['countryCode'],
                                   $row['phone'],
                                   $row['email'],
                                   $row['password']);
        $customer->setcustomerID($row['customerID']);
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
                  WHERE customerID = '$customerID'";
    try{
        $row_count = $db->exec($query);
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
                  WHERE customers.customerID = '$customerID'";
    try{    
        $result = $db->query($query);
        $registrations = array();
        foreach ($result as $row) {
            $registration = new Registration($row['productCode'],
                                   $row['registrationDate']);
            $registration->setcustomerID($row['customerID']);
            $product = ProductDB::getProduct($row['productCode']);
            $productName = $product->getName();
            $registration->setproductName($productName);
            $registrations[] = $registration;
        }
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
        $row_count = $db->exec($query);
        return $row_count;
    }catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
    }
    }
}
?>