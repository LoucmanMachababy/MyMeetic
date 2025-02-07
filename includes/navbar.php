<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body>
    <div class="navbar-container">
        <div class="leftnav-container">
            <h4>Nos ambitions</h4>
            <h4>Assistance</h4>
        </div>
        <div class="logo">
            <img src="../Images/logo.png" alt="logo" id="logo">
        </div>
        <div class="rightnav-container">
            <?php if (isset($_SESSION['auth'])): ?>
                <h4>Bonjour, <?php echo htmlspecialchars($_SESSION['firstname']); ?></h4>
                <a href="logoutAction.php">
                    <h4>Se déconnecter</h4>
                </a>
            <?php else: ?>
                <a href="../views/login.php">
                    <h4>Connexion</h4>
                </a>
                <a href="/views/signup.php">
                    <h4>S'inscrire</h4>
                </a>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>