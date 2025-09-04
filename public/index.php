<?php
// Inclure autoload et configuration
require_once __DIR__ . '/../app.php';

// Récupérer l'URL demandée
$uri = $_SERVER['REQUEST_URI']; // ex: /user/index
$route = trim($uri, '/');

// ⚡ Redirection si la route se termine par /index
if (substr($route, -5) === 'index') { // 'index' = 5 lettres
    $newRoute = substr($route, 0, -5);
    $newRoute = rtrim($newRoute, '/'); // enlever slash final
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

// Vérifier si le controller existe
if (class_exists($controllerName)) {
    $controller = new $controllerName($db);

    if (method_exists($controller, $method)) {
        // Appel dynamique
        call_user_func_array([$controller, $method], $params);
    } else {
        http_response_code(404);
        echo "Méthode '$method' introuvable dans $controllerName.";
    }
} else {
    http_response_code(404);
    echo "Contrôleur '$controllerName' introuvable.";
}
