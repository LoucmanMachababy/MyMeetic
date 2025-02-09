<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<link rel="stylesheet" href="../styles/navbar.css">
<div class="navbar-container">
    <div class="leftnav-container">
        <div class="logo">
            <img src="../Images/logo.png" alt="Logo">
        </div>
    </div>

    <div class="rightnav-container">
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <?php if (!empty($_SESSION['auth']) && $_SESSION['auth'] === true): ?>
                <li><a href="MonCompte.php">Mon compte</a></li>
                <li><a href="logout.php">Se déconnecter</a></li>
            <?php else: ?>
                <li><a href="login.php">Se connecter</a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>
