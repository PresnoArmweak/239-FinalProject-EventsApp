<?php 

function get_pdo(): PDO
{
    $host = 'localhost';
    $db   = 'event_planner';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false, // runs all prepares natively. allows dynamic sql and does not replace parameters with the literal values
    ];
    return new PDO($dsn, $user, $pass, $opt);
}


?>