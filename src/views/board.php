<?php
/**
 * @var array $data
 */
?>
<html>
<?php include "src/ui/head.php" ?>
<body class="app">
<?php include "src/ui/header.php" ?>
<div class="content">
    <div class="board__cards">
        <?php foreach ($data["cards"] as $card) { ?>
        <div class="card card--<?= isTooBusyCard($card) ?>">
            <p class="card__value"><?= $card["free"] ?> <span>/ <?= $card["count"] ?></span></p>
            <p class="card__title"><?= $card["title"] ?></p>
        </div>
        <?php } ?>
    </div>
</div>
</body>
</html>