<?php

// Inicio da Sessão
session_start();

// Rotas permitidas
$routes = require_once __DIR__ . "/../src/routes.php";

// Definições regras das rotas

//se não existir route então por defeito é 'home'
$route = $_GET['route'] ?? 'home';

// User existe/login feito?
if (!isset($_SESSION['user']) && $route != 'login_submit') {
    $route = 'login';
}

// se existe user e rota é 'login' então vai para 'home'
if (isset($_SESSION['user']) && $route === 'login') {
    $route = 'home';
}

// verificar se a rota é permitida, se existe dentro do array
if (!in_array($route, $routes)) {
    $route = '404';
}

// Preparação das paginas == rotas e ficheiros templates
$template = null;

switch ($route) {
    case 'home':
        $template = 'home.php';
        break;
    case 'login':
        $template = 'login.php';
        break;
    case 'login_submit':
        $template = 'login_submit.php';
        break;
    case 'logout':
        $template = 'logout.php';
        break;
    case 'blog':
        $template = 'blog.php';
        break;
    case '404':
        $template = '404.php';
        break;
}

require_once __DIR__ . "/../src/config.php";
require_once __DIR__ . "/../src/db.php";

// Apresentação das paginas conforme templates
require_once __DIR__ . "/../templates/base/header.php";
require_once __DIR__ . "/../templates/$template";
require_once __DIR__ . "/../templates/base/footer.php";
