<?php
require_once __DIR__ . '/../app.php';

session_start(); // toujours au début pour la session

$uri = $_SERVER['REQUEST_URI']; // ex: /user/index
$route = trim($uri, '/');

// ⚡ Redirection si la route se termine par /index
if (substr($route, -5) === 'index') { 
    $newRoute = substr($route, 0, -5);
    $newRoute = rtrim($newRoute, '/'); 
    header("Location: /$newRoute", true, 301);
    exit;
}

// Séparer controller/method/params
$parts = explode('/', $route);

// Controller : premier segment ou 'home' par défaut
$controllerName = ucfirst($parts[0] ?? 'home') . 'Controller';

// Méthode : deuxième segment ou 'index' par défaut
$method = $parts[1] ?? 'index';

// Paramètres : reste des segments
$params = array_slice($parts, 2);

// === Vérification d'authentification ===
// Liste des routes publiques (ex: login, register)
$publicRoutes = [
    'login/index',
    'login/authenticate',
    'register/index',
    'register/create',
];

$currentRoute = strtolower($parts[0] ?? 'home') . '/' . strtolower($method);

if (!in_array($currentRoute, $publicRoutes)) {
    if (!isset($_SESSION['user_id'])) {
        header("Location: /login/index");
        exit;
    }
}

// Vérifier si le controller existe
if (class_exists($controllerName)) {
    $controller = new $controllerName($db);

    if (method_exists($controller, $method)) {
        call_user_func_array([$controller, $method], $params);
    } else {
        http_response_code(404);
        echo "Méthode '$method' introuvable dans $controllerName.";
    }
} else {
    http_response_code(404);
    echo "Contrôleur '$controllerName' introuvable.";
}
