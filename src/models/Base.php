<?php
class Base {
    protected $conn;
    protected $table;

    public function __construct($db, $table) {
        $this->conn = $db;
        $this->table = $table;
    }

    public function getAll() {
        $db = $this->conn->prepare("SELECT * FROM {$this->table}");
        $db->execute();
        return $db->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $db = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $db->execute(["id" => $id]);
        return $db->fetch(PDO::FETCH_ASSOC);
    }

    public function add($data) {
        $fields = array_keys($data);
        $columns = implode(", ", $fields);
        $placeholders = ":" . implode(", :", $fields);

        $db = $this->conn->prepare("INSERT INTO {$this->table} ($columns) VALUES ($placeholders)");
        return $db->execute($data);
    }

    public function update($id, $data) {
        $set = implode(", ", array_map(fn($f) => "$f = :$f", array_keys($data)));
        $db = $this->conn->prepare("UPDATE {$this->table} SET $set WHERE id = :id");
        $data["id"] = $id;
        return $db->execute($data);
    }

    public function delete($id) {
        $db = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $db->execute(["id" => $id]);
    }
}
