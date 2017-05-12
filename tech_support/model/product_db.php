<?php
class ProductDB {
    public static function getProducts() {
        $db = Database::getDB();
        $query = 'SELECT * FROM products';
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
    }

    public static function getProduct($productCode) {
        $db = Database::getDB();
        $query = "SELECT * FROM products
                  WHERE productCode = '$productCode'";
        $result = $db->query($query);
        $row = $result->fetch();
        $product = new Product($row['productCode'],
                                   $row['name'],
                                   $row['version'],
                                   $row['releaseDate']);
        return $product;
    }

    public static function getProductName($productCode) {
        $db = Database::getDB();
        $query = "SELECT * FROM products
                  WHERE productCode = '$productCode'";
        $result = $db->query($query);
        $row = $result->fetch();
        $product = new Product($row['productCode'],
                                   $row['name'],
                                   $row['version'],
                                   $row['releaseDate']);
        return $product->getName();
    }

    public static function deleteProduct($productCode) {
        $db = Database::getDB();
        $query = "DELETE FROM products
                  WHERE productCode = '$productCode'";
        $row_count = $db->exec($query);
        return $row_count;
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

        $row_count = $db->exec($query);
        return $row_count;
    }
}
?>