<?php
require_once __DIR__ . '/config/database.php';

$database = new Database();
$conn = $database->getConnection();

try {
    $stmt = $conn->query("SELECT DATABASE();");
    $dbName = $stmt->fetchColumn();

    echo "✅ Connected to database: " . $dbName;
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
