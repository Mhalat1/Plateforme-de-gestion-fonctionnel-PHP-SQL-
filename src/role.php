<?php

ob_start();
require_once 'config.php';
$sql = "SELECT id,role_name FROM role";
$result = $conn->query($sql);
?>

<?php if ($result->num_rows > 0) : ?>
    <table>
        <tr>
            <th>ID</th>
            <th>role_name</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['id'] ?> </td>
                <td><?= $row['role_name'] ?></td>
            </tr>
        <?php endwhile ?>
    </table>
<?php else : ?>
    <p> pas de resultat </p>
<?php endif;

$content = ob_get_clean();
require 'layout.php';
