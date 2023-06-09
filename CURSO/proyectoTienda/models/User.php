<?php

class User {

    private $id;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $rol;
    private $image;
    private $db;
    
    public static function getAllUsers() {
        $db = Database::connect();
        $query = $db->query("SELECT * FROM users ORDER BY id;");
        $result = false;
        for ($i = 0; $temp = $query->fetch_object(); $i++) {
            $result[$i] = new User($temp->id, $temp->rol, $temp->email, $temp->password, $temp->name, $temp->surname, $temp->image);
        }
        return $result;
    }

    public function __construct($id = null, $rol = 'user', $email = null, $password = null, $name = null, $surname = null, $image = null) {
        $this->db = Database::connect();
        
        $this->id = $id;
        $this->setName($name);
        $this->setSurname($surname);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->rol = $rol;
    }
    
    public function fetch($userId) {
        $temp = $this
                ->db
                ->query("SELECT * FROM users WHERE id = $userId;")
                ->fetch_object();
        return new User($temp->id, $temp->rol, $temp->email, $temp->password, $temp->name, $temp->surname, $temp->image);
    }
    
    public function getDb() {
        return $this->db;
    }
        public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getImage() {
        return $this->image;
    }

    public function setName($name): void {
        $this->name = $this->db->real_escape_string(trim($name));
    }

    public function setSurname($surname): void {
        $this->surname = $this->db->real_escape_string(trim($surname));
    }

    public function setEmail($email): void {
        $this->email = $this->db->real_escape_string(trim($email));
    }

    public function setPassword($password): void {
        $this->password = password_hash($this->db->real_escape_string(trim($password)), PASSWORD_BCRYPT, ['cost'=>4]);
    }
    
    public function setPasswordForLogin($password): void {
        $this->password = trim($password);
    }

    public function setRol($rol): void {
        $this->rol = $rol;
    }

    public function setImage($image): void {
        $this->image = $image;
    }
    
    public function setId($id): void {
        $this->id = $id;
    }
    
    public function login() {
        $login = $this->db->query("SELECT * FROM users WHERE email = '{$this->email}'");
        
        if ($login && $login->num_rows == 1) {
            $user = $login->fetch_object();
            $checkPassword = password_verify($this->password, $user->password);
            $this->setPassword($this->password);
        }
        
        return $checkPassword && isset($user) ? $user:false;
    }

    public function save() {
        $save = $this->db->query("INSERT INTO users VALUES(null, '$this->name', '$this->surname', '$this->email', '$this->password', '$this->rol', null);");
        $this->setId($this->db->query("SELECT id FROM users WHERE email = '$this->email' LIMIT 1")->fetch_object()->id);
        return $save;
    }
}