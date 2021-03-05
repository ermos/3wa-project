<?php
/**
 * @var array $data
 */
?>
<html>
<?php include "src/ui/head.php" ?>
<body class="app">
<header class="header">
    <div class="header__content">
        <a href="/"><h1 class="header__logo"><?= APP_NAME ?><span>.</span></h1></a>
        <nav class="header__nav">
            <a <?= CURRENT_PAGE === "Home" ? 'class="active"' : '' ?> href="/">Accueil</a>
            <a href="#">Paramètres</a>
            <a href="/?p=logout">Se déconnecter</a>
        </nav>
    </div>
</header>
</body>
</html>