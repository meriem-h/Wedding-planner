<?php
// Charger Base en priorité
require_once __DIR__ . '/src/models/Base.php';

// Autoload pour toutes les autres classes
spl_autoload_register(function($class) {
    $dirs = [
        __DIR__ . '/src/models/',
        __DIR__ . '/src/controllers/',
    ];
    foreach ($dirs as $dir) {
        $file = $dir . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
