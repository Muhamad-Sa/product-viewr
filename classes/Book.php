<?php
require_once 'Product.php';

class Book extends Product {
    private $weight;

    public function __construct($sku, $name, $price, $weight) {
        parent::__construct($sku, $name, $price);
        $this->weight = $weight;
    }

    public function getAttributes() {
        return "Weight: " . $this->weight . " Kg";
    }

    public function setWeight($weight) { $this->weight = $weight; }
    public function getWeight() { return $this->weight; }
}
?>
