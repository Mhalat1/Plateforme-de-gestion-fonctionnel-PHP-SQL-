<?php
require_once 'config.php';
$role_id = $_GET['role_id'];
$sql = "DELETE FROM user_role WHERE role_id=$role_id";
$result = $conn->query($sql);
if ($result) {
    // echo "Utilisateur supprimé avec succès.";
    header('location:user_role.php');
} else {
    echo "Erreur : " . $sql . "<br>" . $conn->error;
}

