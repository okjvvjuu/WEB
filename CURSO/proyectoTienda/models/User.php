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

    public function __construct($email = null, $password = null, $name = null, $surname = null) {
        $this->db = Database::connect();
        
        $this->setName($name);
        $this->setSurname($surname);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->rol = 'user';
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
    
    public function login() {
        $login = $this->db->query("SELECT * FROM users WHERE email = '{$this->email}'");
        
        if ($login && $login->num_rows == 1) {
            $user = $login->fetch_object();
            $checkPassword = password_verify($this->password, $user->password);
            $this->setPassword($this->password);
        }
        
        return $checkPassword && $user ? $user:false;
    }

    public function save() {
        $save = $this->db->query("INSERT INTO users VALUES(null, '{$this->name}', '{$this->surname}', '{$this->email}', '{$this->password}', 'user', null);");
        return $save ? true:false;
    }
}