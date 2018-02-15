<?php
require_once(__DIR__."'/../../config.php");

$link = mysqli_connect($host, $user, $pass, $base, $port);

// Validar conexão
if (!$link) {
    header("location: 500.php");
}

$link->set_charset("utf8");
date_default_timezone_set('America/Sao_Paulo');