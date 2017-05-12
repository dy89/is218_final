<?php
class Incident {
    private $incidentID, $customerID, $productCode, $techID, $dateOpened, $dateClosed, $title, $description;

    public function __construct($customerID, $productCode, $techID, $dateOpened, $dateClosed, $title, $description) {
        $this->customerID = $customerID;
        $this->productCode = $productCode;
        $this->techID = $techID;
        $this->dateOpened = $dateOpened;
        $this->dateClosed = $dateClosed;
        $this->title = $title;
        $this->description = $description;
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

    public function gettechID() {
        return $this->techID;
    }

    public function settechID($value) {
        $this->techID = $value;
    }

    public function getdateOpened() {
        return $this->dateOpened;
    }

    public function setdateOpened($value) {
        $this->dateOpened = $value;
    }

    public function getdateClosed() {
        return $this->dateClosed;
    }

    public function setdateClosed($value) {
        $this->dateClosed = $value;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($value) {
        $this->title = $value;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($value) {
        $this->description = $value;
    }

    public function getincidentID() {
        return $this->incidentID;
    }

    public function setincidentID($value) {
        $this->incidentID = $value;
    }
}
?>