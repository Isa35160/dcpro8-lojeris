<?php

require_once "config/parameters.php";

try {
    $connection = new PDO("mysql:dbname=" . $param["dbname"] . ";host=" . $param["host"], $param["user"], $param["pass"]);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $connection->exec("SET names utf8");
    $connection->exec("SET lc_time_names = 'fr_FR'");
} catch (PDOException $exc) {
    echo "Erreur de connexion à la BDD";
    die;
}

$entity_dir = __DIR__ . "/entity/";
$files = scandir($entity_dir);
foreach ($files as $file) {
    if (is_file($entity_dir . $file) && pathinfo($entity_dir . $file, PATHINFO_EXTENSION) == "php") {
        require_once $entity_dir . $file;
    }
}