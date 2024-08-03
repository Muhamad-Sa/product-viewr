<?php
require_once 'Product.php';

class DVD extends Product {
    private $size;

    public function __construct($sku, $name, $price, $size) {
        parent::__construct($sku, $name, $price);
        $this->size = $size;
    }

    public function getAttributes() {
        return "Size: " . $this->size . " MB";
    }

    public function setSize($size) { $this->size = $size; }
    public function getSize() { return $this->size; }
}
?>
