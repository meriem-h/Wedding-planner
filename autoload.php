<?php
// Charger Base en priorité
require_once __DIR__ . '/src/Core/Base.php';
require_once __DIR__ . '/src/Core/Controller.php';

// Autoload pour toutes les autres classes
spl_autoload_register(function($class) {
    $dirs = [
        __DIR__ . '/src/Models/',
        __DIR__ . '/src/Controllers/',
    ];
    foreach ($dirs as $dir) {
        $file = $dir . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
