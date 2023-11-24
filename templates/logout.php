<?php

// destrói a sessão
session_destroy();

// redireciona para a página inicial
header('Location: http://' . $_SERVER['HTTP_HOST'] . '/?route=home');