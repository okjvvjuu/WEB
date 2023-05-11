<?php

class Product {

    private $id;
    private $category_id;
    private $name;
    private $description;
    private $price;
    private $stock;
    private $sale;
    private $date;
    private $image;
    private $db;

    public function __construct($name, $price, $date, $stock, $description = null, $sale = null, $image = null, $category_id = null) {
        $this->db = Database::connect();
        
        $this->id = null;
        $this->setName($name);
        $this->setPrice($price);
        $this->setDate($date);
        $this->setStock($stock);
        $this->setDescription($description);
        $this->setSale($sale);
        $this->setImage(null);
        $this->setCategory_id($category_id);
    }

    public function exists(): bool {
        return $this
                        ->db
                        ->query("SELECT * FROM products WHERE id = '" . $_GET['id'] . "';")
                ->num_rows > 0;
    }

    public function deleteSelfFromDatabase(): void {
        $this
                ->db
                ->query("DELETE FROM products WHERE id = '" . $_GET['id'] . "';");
    }

    public function save(): void {
        $this
                ->db
                ->query("INSERT INTO products VALUES ("
                        . "null, "
                        . $this->category_id . ", '"
                        . $this->name . "', '"
                        . $this->description . "', '"
                        . $this->price . "', '"
                        . $this->stock . "', '"
                        . $this->sale . "', '"
                        . $this->date . "', '"
                        . $this->image . "WIP'"
                        . ");"
        );
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setCategory_id($category_id): void {
        $this->category_id = $this->db->real_escape_string(htmlspecialchars($category_id));
    }

    public function setName($name): void {
        $this->name = $this->db->real_escape_string(htmlspecialchars($name));
    }

    public function setDescription($description): void {
        $this->description = $this->db->real_escape_string(htmlspecialchars($description));
    }

    public function setPrice($price): void {
        $this->price = $this->db->real_escape_string(htmlspecialchars($price));
    }

    public function setStock($stock): void {
        $this->stock = $this->db->real_escape_string(htmlspecialchars($stock));
    }

    public function setSale($sale): void {
        $this->sale = $this->db->real_escape_string(htmlspecialchars($sale));
    }

    public function setDate($date): void {
        $this->date = $this->db->real_escape_string(htmlspecialchars($date));
    }

    public function setImage($image): void {
        $this->image = $image;
    }

    public function setDb($db): void {
        $this->db = $db;
    }

    public function getId() {
        return $this->id;
    }

    public function getCategory_id() {
        return $this->category_id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getSale() {
        return $this->sale;
    }

    public function getDate() {
        return $this->date;
    }

    public function getImage() {
        return $this->image;
    }

}
