<?php

// Пути к папкам
define('PUBLIC_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('ROOT', dirname(PUBLIC_ROOT));
define('APP_ROOT', ROOT . '/src/App/');
define('CONTROLLER_PATH', APP_ROOT . 'Controllers/');
define('MODEL_PATH', APP_ROOT . 'Models/');
define('VIEW_PATH', APP_ROOT . 'Views/');
define('LAYOUTS_PATH', VIEW_PATH . 'Layouts/');

// Имена по умолчанию
define('DEFAULT_LAYOUT', 'default');
define('ACTION_POSTFIX', 'Action');

// Маршруты роутера
