<?php
require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/src/config/Database.php';

// Initialiser la base de données
$database = new Database();
$db = $database->getConnection();

// Stocker globalement si nécessaire
$GLOBALS['db'] = $db;
