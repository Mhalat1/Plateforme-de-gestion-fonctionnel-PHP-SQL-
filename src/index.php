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
// src/users/index.php
ob_start();
require_once 'config.php';

$sql = "SELECT users.id, username, email, GROUP_CONCAT(role_name) as role_name
FROM users
left JOIN user_role ON users.id = user_role.user_id
left JOIN roles ON user_role.role_id = roles.id
GROUP BY users.id
ORDER BY users.id";
$result = $conn->query($sql);
$users = $result->fetch_all(MYSQLI_ASSOC);
// var_dump($users);
?>
<?php if ($result->num_rows > 0) : ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom d'utilisateur</th>
            <th>Email</th>
            <th>Roles</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user['id'] ?></td>
                <td>
                    <a href="form_update.php?id=<?= $user['id'] ?>">
                        <?= $user['username'] ?>
                    </a>
                </td>
                <td><?= $user['email'] ?></td>
                <td>
                    <?php
                    if ($user['role_name']) :
                        $roles = explode(',', $user['role_name']);
                        foreach ($roles as $role) : ?>
                            <span class="badge <?= $role ?>"><?= $role ?></span>
                        <?php endforeach ?>
                    <?php endif ?>
                </td>
                <td>
                    <a href="delete.php?id=<?= $user['id'] ?>">🗑️</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
<?php else : ?>
    <p>Pas de résultats</p>
<?php endif;

$title = 'Liste des utilisateurs';
$content = ob_get_clean();
require 'layout.php';