<?php
abstract class Product {
    protected $sku;
    protected $name;
    protected $price;

    public function __construct($sku, $name, $price) {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }

    // Abstract method for getting product-specific attributes
    abstract public function getAttributes();

    // Setters and Getters
    public function setSku($sku) { $this->sku = $sku; }
    public function getSku() { return $this->sku; }

    public function setName($name) { $this->name = $name; }
    public function getName() { return $this->name; }

    public function setPrice($price) { $this->price = $price; }
    public function getPrice() { return $this->price; }
}
?>
