<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
</head>
<body>
</body>
</html>



<?php
// src/users/form_update.php
ob_start();
require_once 'config.php';

$id = $_GET['id'];

// Obtenir les informations de l'utilisateur
$sql = "SELECT id, username, email FROM users WHERE id = $id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Obtenir tous les rôles disponibles
$sql_roles = "SELECT id, role_name FROM roles";
$result_roles = $conn->query($sql_roles);
$roles = $result_roles->fetch_all(MYSQLI_ASSOC);

// Obtenir les rôles de l'utilisateur
$sql_user_roles = "SELECT role_id FROM user_role WHERE user_id = $id";
$result_user_roles = $conn->query($sql_user_roles);
$user_roles = $result_user_roles->fetch_all(MYSQLI_ASSOC);
$user_roles_ids = array_column($user_roles, 'role_id');
?>

<form action="update.php" method="post">
    ID:
    <input type="text" name="id" value="<?= $id ?>" readonly><br>
    Nom d'utilisateur:
    <input type="text" name="username" value="<?= $user['username'] ?>"><br>
    Email:
    <input type="email" name="email" value="<?= $user['email'] ?>"><br>
    Rôles:
    <select name="roles[]" multiple>
        <?php foreach($roles as $role): ?>
            <option value="<?= $role['id'] ?>" <?= in_array($role['id'], $user_roles_ids) ? 'selected' : '' ?>>
                <?= $role['role_name'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <button>Mettre à jour</button>
</form>

<?php
$title = "Modification d'utilisateur";
$content = ob_get_clean();
require 'layout.php';