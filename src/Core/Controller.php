<?php

class Controller
{
    protected function render(string $view, array $data = [], $layout = true)
    {
        // Transforme chaque clé de $data en variable utilisable dans la vue
        extract($data);

        // Chemin complet vers la vue
          $viewPath = __DIR__ . '/../View/' . $view . '.html';
          $scriptPath = __DIR__ . '/../View/script.html';
          $headerPath = __DIR__ . '/../View/header.html';
          $footerPath = __DIR__ . '/../View/footer.html';

        if (file_exists($viewPath)) {
            require $scriptPath;

            $layout && require $headerPath;
            require $viewPath;
            $layout && require $footerPath;

        } else {
            echo "View not found: " . $viewPath;
        }
    }



    protected function redirect(string $url, array $data = [],int $statusCode = 302)
    {
        header("Location: $url", true, $statusCode);
        exit; 
    }



    /**
     * Vérifie si l'utilisateur est connecté
     * Sinon, redirige vers login/index
     */
    protected function checkAuth()
    {
        session_start(); // démarrer la session si ce n'est pas déjà fait

        if (!isset($_SESSION['user_id'])) {
            header("Location: /login/index");
            exit;
        }
    }





}
