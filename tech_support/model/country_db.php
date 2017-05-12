<?php
class CountryDB {
    public static function getCountries() {
            $db = Database::getDB();
            $query = 'SELECT * FROM countries';
    try{       
            $result = $db->query($query);
            $countries = array();
            foreach ($result as $row) {
                $country = new Country($row['countryCode'],
                                    $row['countryName']);
                $countries[] = $country;
            }
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
        return $country;
        }catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
    }
    }

}
?>