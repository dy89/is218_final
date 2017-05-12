<?php
class CustomerDB {
    public static function getCustomers($lastName) {
        $db = Database::getDB();
        $query = "SELECT * FROM customers
                  WHERE lastName = '$lastName'";
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
    }

    public static function getCustomer($customerID) {
        $db = Database::getDB();
        $query = "SELECT * FROM customers
                  WHERE customerID = '$customerID'";
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
    }
    
    public static function getCustomerEmail($email) {
        $db = Database::getDB();
        $query = "SELECT * FROM customers
                  WHERE email = '$email'";
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
        $row_count = $db->exec($query);
        return $row_count;
    }
}
?>