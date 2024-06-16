<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title ?></title>
		<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <header class="mb-4">
            <h1 class="text-3xl font-bold">Gestion des Utilisateurs</h1>
            <nav>
                <a href="form_add.php" class="text-blue-500 hover:underline">Inscription</a>
                <a href="index.php" class="text-blue-500 hover:underline ml-4">Liste des Utilisateurs</a>
            </nav>
        </header>
        <main>
            <?php echo $content ?>
        </main>
    </div>
</body>
</html>