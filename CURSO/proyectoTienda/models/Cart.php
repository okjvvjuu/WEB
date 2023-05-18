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

    public function update() {
        $db = Database::connect();
        $newProducts = $db->query("SELECT id, date FROM products ORDER BY date DESC")->fetch_all();

        $check = false;
        for ($i = 0; $i < count($newProducts) && !$check; $i++) {
            $lastDate = $newProducts[$i][1];
	    $curDate = $lastDate;
            if (!is_null($this->content[$newProducts[$i][0]])) {
		$curDate = $this->content[$newProducts[$i][0]]['product']->getDate();
            }
            $check = $lastDate > $curDate;
        }

        if ($check) {
            //Actualizar productos
            for ($i = 0; $i < count($newProducts); $i++) {
                $id = $newProducts[$i][0];
                $date = $newProducts[$i][1];
                if ($this->content[$id]['product']->getDate() < $date) {
                    $temp = $db->query("SELECT * FROM products WHERE id = $id LIMIT 1;")->fetch_object();
                    //Actualizar totalCost
                    $this->totalCost += (($temp->price - $this->content[$id]['product']->getPrice()) * $this->content[$id]['quantity']);
                    $this->content[$id]['product'] = new Product($temp->id, $temp->name, $temp->price, $temp->date, $temp->stock, $temp->description, $temp->sale, $temp->image, $temp->category_id);
                }
            }
        }
        return $this;
    }

}
