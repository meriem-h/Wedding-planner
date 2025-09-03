<?php
require_once __DIR__ . '/../app.php';

$user = new User($db);


$singleUser = $user->getById(1);
echo "<h2>User ID 1:</h2>";
echo "<pre>";
print_r($singleUser);
echo "</pre>";



$emailUser = $user->findByEmail("meriem@test.com");
echo "<h2>User email : meriem@test.com</h2>";
echo "<pre>";
print_r($emailUser);
echo "</pre>";



$auth = $user->authenticate("meriem@test.com", "123456");
echo "<h2>Authentification:</h2>";
echo "<pre>";
print_r($auth);
echo "</pre>";
