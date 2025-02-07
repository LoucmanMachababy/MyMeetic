<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>

<?php
if (isset($_SESSION['auth'])) {
    include __DIR__ . '/includes/navbar.php';
}
?>

<div class="content">
    <h1>Bienvenue sur Afrika</h1>
    <p>L'amour se trouve autour du continent</p>
</div>

</body>
</html>