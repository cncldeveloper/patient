<?php
/**
 * @var $pdo
 */
include "config.php";

// LOGIN CHECK
if (empty($_SESSION['user'])) {
    header('LOCATION: login.php');
    exit();
}

// DELETE PROFILE
try {
    $stmt = $pdo->prepare("DELETE FROM registration WHERE id=?");
    $stmt->execute([$_SESSION['user']->id]);
    unset($_SESSION['user']);
    session_destroy();
    header('LOCATION: registration.php');
} catch (Exception $exception) {
    header('LOCATION: index.php?error=' . $exception->getMessage());
}
