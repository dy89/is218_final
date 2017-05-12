<?php
class RegistrationDB {
    public static function getRegistrations($customerID) {
        $db = Database::getDB();
        $query = 'SELECT * FROM registrations
                  INNER JOIN customers
                      ON registrations.customerID = customers.customerID';
        $result = $db->query($query);
        $products = array();
        foreach ($result as $row) {
            $category = new Category($row['categoryID'],
                                     $row['categoryName']);
            $product = new Product($category,
                                   $row['productCode'],
                                   $row['productName'],
                                   $row['listPrice']);
            $product->setId($row['productID']);
            $products[] = $product;
        }
        return $products;
    }

    public static function getRegistrationsbyID($customerID) {
        $db = Database::getDB();

        $customerID = CustomerDB::getCustomer($customerID);

        $query = "SELECT * FROM registrations
                  WHERE customerID = '$customer_id'";
        $result = $db->query($query);
        $registrations = array();
        foreach ($result as $row) {
            $registration = new Registration($row['productCode'],
                                   $row['registrationDate']);
            $registration->setcustomerID($row['customerID']);
            $registrations[] = $registration;
        }
        return $products;
    }

    public static function addRegistration($registration) {
        $db = Database::getDB();

        $customerID = $registration->getcustomerID();
        $productCode = $registration->getproductCode();
        $registrationDate = $product->getregistrationDate();

        $query =
            "INSERT INTO registrations
                 (customerID, productCode, registrationDate)
             VALUES
                 ('$customerID', '$productCode', '$registrationDate')";

        $row_count = $db->exec($query);
        return $row_count;
    }
}
?>