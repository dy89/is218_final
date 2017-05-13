<?php
class CountryDB {
    public static function getCountries() {
        $db = Database::getDB();
        $query = 'SELECT * FROM countries';
        try{       
            $statement = $db->prepare($query);
            $statement->execute();
            $countries = array();
            $result = $statement->fetch();
            while ($result != null){
                $country = new Country($result['countryCode'],
                                       $result['countryName']);
                $countries[] = $country;
                $result = $statement->fetch();
            }
            $statement->closeCursor();     
            return $countries;
        }catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }

    public static function getCountrybyName($countryCode) {
        $db = Database::getDB();
        $query = "SELECT * FROM countries
                  WHERE countryCode = '$countryCode'";
        try{
            $result = $db->query($query);
            $row = $result->fetch();
            $country = new Country($row['countryCode'],
                                   $row['countryName']);
            return $country->getcountryName();
        }catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
    }
    }

}
?>