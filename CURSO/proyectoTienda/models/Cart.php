<?php

require_once './models/Product.php';

class Cart {

    private $content;
    private $totalCost;

    public function __construct() {
        $content = array();
        $totalCost = 0;
    }

    public function getContent() {
        return $this->content;
    }

    public function getTotalCost() {
        return $this->totalCost;
    }

    public function setContent($content): void {
        $this->content = $content;
    }

    public function setTotalCost($totalCost): void {
        $this->totalCost = $totalCost;
    }

    public function addProduct($product, $qty = 1) {
        $qty = (int) $qty;
        if (!$this->containsProduct($product)) {
            $this->content[$product->getId()] = array('product' => $product, 'quantity' => $qty);
        } else {
            $this->content[$product->getId()]['quantity'] += $qty;
        }
        $this->totalCost += $product->getPrice() * $qty;
        if ($this->content[$product->getId()]['quantity'] <= 0) {
            $this->totalCost -= $product->getPrice() * $this->content[$product->getId()]['quantity'];
            unset($this->content[$product->getId()]);
        }
    }

    public function containsProduct($product) {
        $result = false;
        foreach ($this->content as $value) {
            if ($value['product']->getId() == $product->getId()) {
                $result = true;
            }
        }
        return $result;
    }

}
