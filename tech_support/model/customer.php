<?php
class Customer {
    private $customerID, $firstName, $lastName, $address, $city, $state, $postalCode, $countryCode, $phone, $email, $password;

    public function __construct($firstName, $lastName, $address, $city, $state, $postalCode, $countryCode, $phone, $email, $password) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->postalCode = $postalCode;
        $this->countryCode = $countryCode;
        $this->phone = $phone;
        $this->email = $email;
        $this->password = $password;
    }

    public function getcustomerID() {
        return $this->customerID;
    }

    public function setcustomerID($value) {
        $this->customerID = $value;
    }

    public function getfirstName() {
        return $this->firstName;
    }

    public function setfirstName($value) {
        $this->firstName = $value;
    }

    public function getlastName() {
        return $this->lastName;
    }

    public function setlastName($value) {
        $this->lastName = $value;
    }

    public function getfullName() {
        return $this->firstName." ".$this->lastName;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($value) {
        $this->address = $value;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($value) {
        $this->city = $value;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($value) {
        $this->state = $value;
    }

    public function getpostalCode() {
        return $this->postalCode;
    }

    public function setpostalCode($value) {
        $this->postalCode = $value;
    }

    public function getcountryCode() {
        return $this->countryCode;
    }

    public function setcountryCode($value) {
        $this->countryCode = $value;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($value) {
        $this->phone = $value;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($value) {
        $this->email = $value;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($value) {
        $this->password = $value;
    }
}
?>