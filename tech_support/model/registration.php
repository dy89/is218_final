<?php
class Registration {
    private $customerID, $productName, $productCode, $registrationDate;

    public function __construct($productCode, $registrationDate) {
        $this->productCode = $productCode;
        $this->registrationDate = $registrationDate;
    }

    public function getcustomerID() {
        return $this->customerID;
    }

    public function setcustomerID($value) {
        $this->customerID = $value;
    }

    public function getproductCode() {
        return $this->productCode;
    }

    public function setproductCode($value) {
        $this->productCode = $value;
    }

    public function getregistrationDate() {
        return $this->registrationDate;
    }

    public function setregistrationDate($value) {
        $this->registrationDate = $value;
    }

    public function getproductName() {
        return $this->productName;
    }

    public function setproductName($value) {
        $this->productName = $value;
    }

}
?>