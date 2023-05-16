<?php

require_once "./config/db.php";

class Category {
    private $id;
    private $name;
    private $db;

    public function __construct($id = null, $name = null) {
        $this->id = $id;
        $this->name = $name;

        $this->db = Database::connect();
    }

    public function exists() : bool {
        return $this->db->query("SELECT * FROM categories WHERE id = '" . $this->id . "';")->num_rows > 0;
    }

    public function deleteSelfFromDatabase() : void {
        $this->db->query("DELETE FROM categories WHERE id = '" . $this->id . "';");
    }

    public function save() : void {
        $this->db->query("INSERT INTO categories VALUES (null, '" . $this->db->real_escape_string(htmlspecialchars($_POST['name'])) . "');");
    }
    
    public function updateSelf() {
        $this
                ->db
                ->query('UPDATE categories SET name = \''.$_POST['name'].'\' WHERE id = '.$this->id);
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDb() {
        return $this->db;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setDb($db): void {
        $this->db = $db;
    }
}