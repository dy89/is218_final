<?php
class ProductDB {
    public static function getProducts() {
        $db = Database::getDB();
        $query = 'SELECT * FROM products';
    try{
        $result = $db->query($query);
        $products = array();
        foreach ($result as $row) {
            $product = new Product($row['productCode'],
                                   $row['name'],
                                   $row['version'],
                                   $row['releaseDate']);
            $products[] = $product;
        }
        return $products;
    }catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }

    public static function getProduct($productCode) {
        $db = Database::getDB();
        $query = "SELECT * FROM products
                  WHERE productCode = '$productCode'";
    try{  
        $result = $db->query($query);
        $row = $result->fetch();
        $product = new Product($row['productCode'],
                                   $row['name'],
                                   $row['version'],
                                   $row['releaseDate']);
        return $product;
    }catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
    }
    }

    public static function getProductName($productCode) {
        $db = Database::getDB();
        $query = "SELECT * FROM products
                  WHERE productCode = '$productCode'";
    try{    
        $result = $db->query($query);
        $row = $result->fetch();
        $product = new Product($row['productCode'],
                                   $row['name'],
                                   $row['version'],
                                   $row['releaseDate']);
        return $product->getName();
    }catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
    }
    }

    public static function deleteProduct($productCode) {
        $db = Database::getDB();
        $query = "DELETE FROM products
                  WHERE productCode = '$productCode'";
    try{
        $row_count = $db->exec($query);
        return $row_count;
    }catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
    }
    }

    public static function addProduct($product) {
        $db = Database::getDB();

        $productCode = $product->getproductCode();
        $name = $product->getName();
        $version = $product->getVersion();
        $releaseDate = $product->getreleaseDate();

        $query =
            "INSERT INTO products
                 (productCode, name, version, releaseDate)
             VALUES
                 ('$productCode', '$name', '$version', '$releaseDate')";
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