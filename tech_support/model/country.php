<?php
class Country {
    private $countryCode, $countryName;

    public function __construct($countryCode, $countryName) {
        $this->countryCode = $countryCode;
        $this->countryName = $countryName;
    }

    public function getcountryCode() {
        return $this->countryCode;
    }

    public function setcountryCode($value) {
        $this->countryCode = $value;
    }

    public function getcountryName() {
        return $this->countryName;
    }

    public function setCountryName($value) {
        $this->countryName = $value;
    }
}
?>