<?php
require_once 'Product.php';

class Furniture extends Product {
    private $height;
    private $width;
    private $length;

    public function __construct($sku, $name, $price, $height, $width, $length) {
        parent::__construct($sku, $name, $price);
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function getAttributes() {
        return "Dimensions: " . $this->height . "x" . $this->width . "x" . $this->length;
    }

    public function setHeight($height) { $this->height = $height; }
    public function getHeight() { return $this->height; }

    public function setWidth($width) { $this->width = $width; }
    public function getWidth() { return $this->width; }

    public function setLength($length) { $this->length = $length; }
    public function getLength() { return $this->length; }
}
?>
