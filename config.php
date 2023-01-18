<?php
session_start();

$hostname = 'localhost';
$username = 'root';
$password = 'chanchal';
$database = 'private_patient';

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database;", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $exception) {
    die("Error message: " . $exception->getMessage());
}
