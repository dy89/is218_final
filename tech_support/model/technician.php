<?php
class Technician {
    private $techID, $firstName, $lastName, $email, $phone, $password, $fullName;

    public function __construct($firstName, $lastName, $email, $phone, $password) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
    }

    public function gettechID() {
        return $this->techID;
    }

    public function settechID($value) {
        $this->techID = $value;
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


    public function getEmail() {
        return $this->email;
    }

    public function setEmail($value) {
        $this->email = $value;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($value) {
        $this->phone = $value;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($value) {
        $this->password = $value;
    }

}
?>