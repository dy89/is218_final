<?php
class Product {
    private $productCode, $name, $version, $releaseDate;

    public function __construct($productCode, $name, $version, $releaseDate) {
        $this->productCode = $productCode;
        $this->name = $name;
        $this->version = $version;
        $this->releaseDate = $releaseDate;
    }

    public function getproductCode() {
        return $this->productCode;
    }

    public function setproductCode($value) {
        $this->productCode = $value;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($value) {
        $this->name = $value;
    }

    public function getVersion() {
        return $this->version;
    }

    public function getVersionFormatted() {
        $formatted_version = number_format($this->version, 1);
        return $formatted_version;
    }

    public function setVersion($value) {
        $this->version = $value;
    }

    public function getreleaseDate() {
        return $this->releaseDate;
    }

    public function setreleaseDate($value) {
        $this->releaseDate = $value;
    }
}
?>