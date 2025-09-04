<?php
class User extends Base {

    public function __construct($db) {
        parent::__construct($db, "user");
    }

    
    public function findByEmail($email) {
        $db = $this->conn->prepare("SELECT * FROM {$this->table} WHERE email = :email");
        $db->execute(["email" => $email]);
        return $db->fetch(PDO::FETCH_ASSOC);
    }

    public function authenticate($email, $password) {
        $user = $this->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
