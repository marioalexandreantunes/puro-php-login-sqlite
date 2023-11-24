<?php

// verifica se aconteceu um post
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/?route=login');
    exit;
}

// dados do POST e verificação

$user = $_POST['text_usuario'] ?? null;
$password = $_POST['text_senha'] ?? null;

if (empty($user) || empty($password)) {
    header('Location: http://' . $_SERVER['HTTP_HOST']. '/?route=login');
    exit;
}

/*
 usando MySql
 
    $db = new database();
    $result = $db->pass_validation($user, $password);

*/

$db = new MySQlite();
$result = $db->pass_validation($user, $password);

if ($result['status'] === 'error') {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/?route=404');
    exit;
}

if($result['data'] === false){
    $_SESSION['error'] = 'Usuário ou senha invádidos';
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/?route=login');
    exit;
}

$_SESSION['user'] = $result['user'];
header('Location: http://' . $_SERVER['HTTP_HOST'] . '/?route=home');

