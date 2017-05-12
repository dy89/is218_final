<?php
class CountryDB {
    public static function getCountries() {
        $db = Database::getDB();
        $query = 'SELECT * FROM countries';
        $result = $db->query($query);
        $countries = array();
        foreach ($result as $row) {
            $country = new Country($row['countryCode'],
                                   $row['countryName']);
            $countries[] = $country;
        }
        return $countries;
    }

    public static function getCountrybyName($countryCode) {
        $db = Database::getDB();
        $query = "SELECT * FROM countries
                  WHERE countryCode = '$countryCode'";
        $result = $db->query($query);
        $row = $result->fetch();
        $country = new Country($row['countryCode'],
                                   $row['countryName']);
        return $country;
    }

}
?>