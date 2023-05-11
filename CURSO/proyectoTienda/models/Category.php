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
        return $this->db->query("SELECT * FROM categories WHERE id = '" . $_GET['id'] . "';")->num_rows > 0;
    }

    public function deleteSelfFromDatabase() : void {
        $this->db->query("DELETE FROM categories WHERE id = '" . $_GET['id'] . "';");
    }

    public function save() : void {
        $this->db->query("INSERT INTO categories VALUES (null, '" . $this->db->real_escape_string(htmlspecialchars($_POST['name'])) . "');");
    }
}