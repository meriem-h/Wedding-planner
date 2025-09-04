<?php

class Controller
{
    protected function render(string $view, array $data = [])
    {
        // Transforme chaque clé de $data en variable utilisable dans la vue
        extract($data);

        // Chemin complet vers la vue
        $viewPath = __DIR__ . '/../View/' . $view . '.html';

        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            echo "View not found: " . $viewPath;
        }
    }
}
