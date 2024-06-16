<?php
// src/users/delete.php
require_once 'config.php';

$id = $_GET['id'];

// Supprimer les rôles associés à l'utilisateur
$sql_delete_roles = "DELETE FROM user_role WHERE user_id = ?";
$stmt_delete_roles = $conn->prepare($sql_delete_roles);
if ($stmt_delete_roles) {
    $stmt_delete_roles->bind_param("i", $id);
    $stmt_delete_roles->execute();
}

// Supprimer l'utilisateur
$sql_delete_user = "DELETE FROM users WHERE id = ?";
$stmt_delete_user = $conn->prepare($sql_delete_user);
if ($stmt_delete_user) {
    $stmt_delete_user->bind_param("i", $id);
    if ($stmt_delete_user->execute()) {
        header('location:index.php');
    } else {
        echo "Erreur : " . $sql_delete_user . "<br>" . $stmt_delete_user->error;
    }
} else {
    echo "Erreur lors de la préparation de la requête : " . $conn->error;
}