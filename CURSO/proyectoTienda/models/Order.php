<?php

class Order {

    private $id;
    private $userId;
    private $province;
    private $location;
    private $direction;
    private $price;
    private $status;
    private $date;
    private $db;

    public static function getAllOrders($userId) {
        $db = Database::connect();
        $result = false;
        $query = $db->query("SELECT * FROM orders WHERE user_id = $userId ORDER BY date;");
        for ($i = 0; $temp = $query->fetch_object(); $i++) {
            $result[$i] = new Order($temp->id, $temp->user_id, $temp->province, $temp->location, $temp->direction, $temp->price, $temp->status, $temp->date);
        }
        return $result;
    }

    /* public static function getOrderedProductsBySomeone($userId, $orderId) {
      //NO TESTADO
      $result = false;
      $db = Database::connect();

      $query = $db
      ->query
      ("SELECT products.*, orders_products.order_id, orders_products.product_id, orders.date AS order_date "
      . "FROM products JOIN orders_products ON products.id = orders_products.product_id JOIN orders ON orders_products.order_id = orders.id "
      . "WHERE product_id IN ("
      . "SELECT product_id FROM orders_products WHERE order_id = $orderId AND user_id = $userId"
      . ") ORDER BY order_date DESC, order_id;"
      );

      for ($i = 0; $temp = $query->fetch_object(); $i++) {
      $result[$i] = new Product($temp->id, $temp->name, $temp->price, $temp->date, $temp->stock, $temp->description, $temp->sale, $temp->image, $temp->category_id);
      }

      return $result; 
      } */

    public function __construct($id = null, $userId = null, $province = null, $location = null, $direction = null, $price = null, $status = null, $date = null) {
        $this->db = Database::connect();

        $this->id = $id;
        $this->userId = $userId;
        $this->setProvince($province);
        $this->setLocation($location);
        $this->setDirection($direction);
        $this->setPrice($price);
        $this->setStatus($status);
        $this->setDate($date);
    }

    public function getOrderedProducts($qty) {
        if ($qty == -1) {
            $limit = '';
        } else {
            $limit = " LIMIT $qty";
        }
        $result = false;
        $query = $this
                ->db
                ->query("SELECT products.*, orders_products.qty FROM products JOIN orders_products ON products.id = orders_products.product_id AND orders_products.order_id = $this->id ORDER BY date DESC$limit;");

        for ($i = 0; $temp = $query->fetch_object(); $i++) {
            $first = (new Product($temp->id, $temp->name, $temp->price, $temp->date, $temp->stock, $temp->description, $temp->sale, $temp->image, $temp->category_id));
            $second = ($temp->qty);
            $result[$i] = array('product' => $first, 'quantity' => $second);
        
        }

        return $result;
    }

    /*public function getOrderedProductsAndQty($qty) {
        if ($qty == -1) {
            $limit = '';
        } else {
            $limit = " LIMIT $qty";
        }
        $result = false;
        $query = $this
                ->db
                ->query("SELECT products.*, orders_products.qty FROM products JOIN orders_products ON products.id = orders_products.product_id  WHERE orders_products.order_id = $this->id ORDER BY products.name DESC$limit;");

        for ($i = 0; $temp = $query->fetch_object(); $i++) {
            $result[$i]['product'] = new Product($temp->id, $temp->name, $temp->price, $temp->date, $temp->stock, $temp->description, $temp->sale, $temp->image, $temp->category_id);
            $result[$i]['quantity'] = $temp->qty;
        }

        return $result;
    }*/

    public function getLastOrder($userId) {
        $temp = $this->db->query("SELECT * FROM orders WHERE user_id = $userId ORDER BY date DESC LIMIT 1;")->fetch_object();
        return new Order($temp->id, $temp->user_id, $temp->province, $temp->location, $temp->direction, $temp->price, $temp->status, $temp->date);
    }

    public function fetch() {
        $result = false;
        if ($this->exists()) {
            $temp = $this->db->query("SELECT * FROM orders WHERE id = $this->id;")->fetch_object();
            $result = new Order($this->id, $temp->user_id, $temp->province, $temp->location, $temp->direction, $temp->price, $temp->status, $temp->date);
        }
        return $result;
    }

    public function save() {
        $check = $this->db->query("INSERT INTO orders VALUES(null,$this->userId,'$this->province','$this->location','$this->direction',$this->price,'$this->status','$this->date');");
        $id = $this->db->query("SELECT id FROM orders WHERE user_id = $this->userId ORDER BY date LIMIT 1;")->fetch_object()->id;
        $this->setId($id);
    }

    public function updateSelf() {
        $this
                ->db
                ->query("UPDATE orders SET user_id = $this->userId, province = '$this->province', location = '$this->location', direction = '$this->direction', price = $this->price, status = '$this->status', date = '$this->date' WHERE id = $this->id;");
    }

    public function exists(): bool {
        return $this->db->query("SELECT * FROM orders WHERE id = '" . $this->id . "';")->num_rows > 0;
    }

    public function deleteSelfFromDatabase() : void {
        $this
                ->db
                ->query("DELETE FROM orders_products WHERE order_id = $this->id;");
        $this
                ->db
                ->query("DELETE FROM orders WHERE id = $this->id;");
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getProvince() {
        return $this->province;
    }

    public function getLocation() {
        return $this->location;
    }

    public function getDirection() {
        return $this->direction;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getStatusForDisplay() {
        $array = OrderStatus::cases();
        $result = null;
        foreach ($array as $case) {
            if ($case->name == $this->status) {
                $result = $case->value;
            }
        }
        return $result;
    }

    public function getDate() {
        return $this->date;
    }

    public function getDb() {
        return $this->db;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setUserId($userId): void {
        $this->userId = $userId;
    }

    public function setProvince($province): void {
        $this->province = $this->db->real_escape_string(htmlspecialchars($province));
    }

    public function setLocation($location): void {
        $this->location = $this->db->real_escape_string(htmlspecialchars($location));
    }

    public function setDirection($direction): void {
        $this->direction = $this->db->real_escape_string(htmlspecialchars($direction));
    }

    public function setPrice($price): void {
        $this->price = $this->db->real_escape_string(htmlspecialchars($price));
    }

    public function setStatus($status): void {
        $this->status = $status;
    }

    public function setDate($date): void {
        $this->date = $this->db->real_escape_string(htmlspecialchars($date));
    }

}
