<?php
class ProductDB {
    public static function getProducts() {
        $db = Database::getDB();
        try{    
            $query = 'SELECT * FROM products';
            
                $statement = $db->prepare($query);
                $statement->execute();
                $products = array();
                $result = $statement->fetch();
                while ($result != null){
                    $product = new Product($result['productCode'],
                                           $result['name'],
                                           $result['version'],
                                           $result['releaseDate']);
                    $products[] = $product;
                    $result = $statement->fetch();
                }
                $statement->closeCursor(); 
                return $products;
        }catch (PDOException $e) {
                $error_message = $e->getMessage();
                display_db_error($error_message);
                exit();
        }
    }

    public static function getProduct($productCode) {
        $db = Database::getDB();
        $query = "SELECT * FROM products
                  WHERE productCode = :productCode";
        try{  
                $statement = $db->prepare($query);
                $statement->bindValue(':productCode', $productCode);
                $statement->execute();
                $result = $statement->fetch();
                $product = new Product($result['productCode'],
                                       $result['name'],
                                       $result['version'],
                                       $result['releaseDate']);
                $statement->closeCursor();
                return $product;
        }catch (PDOException $e) {
                $error_message = $e->getMessage();
                display_db_error($error_message);
        }
    }

    public static function getProductName($productCode) {
        $db = Database::getDB();
        $query = "SELECT * FROM products
                  WHERE productCode = :productCode";
        try{    
                $statement = $db->prepare($query);
                $statement->bindValue(':productCode', $productCode);
                $statement->execute();
                $result = $statement->fetch();
                $product = new Product($result['productCode'],
                                       $result['name'],
                                       $result['version'],
                                       $result['releaseDate']);
                $statement->closeCursor();
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
                $statement = $db->prepare($query);
                $statement->bindValue(':productCode', $productCode);
                $statement->execute();
                $row_count = $statement->rowCount();
                $statement->closeCursor();
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