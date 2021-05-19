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
    <main class="main">
        <div class="block board__search">
            <p>Je recherche une</p>
            <select id="search-room-type" class="search__select">
                <option value="" disabled selected>...</option>
                <option value="1">Chambre 1L</option>
                <option value="1">Chambre 2L</option>
                <option value="1">Chambre 3L</option>
                <option value="1">Chambre 4L</option>
            </select>
            <select id="search-available" class="search__select">
                <option value="" disabled selected>...</option>
                <option value="1">Disponible</option>
                <option value="1">Occupé</option>
            </select>
            <p>entre</p>
            <input id="search-date-min" class="search__date" type="date" min="<?= date('Y-m-d'); ?>">
            <p>et</p>
            <input id="search-date-max" class="search__date" type="date" min="<?= date('Y-m-d'); ?>">
            <button id="search-submit" class="search__btn btn btn--neutral">Afficher</button>
        </div>
    </main>
    <aside class="aside">
        <div class="block">Hey</div>
    </aside>
</div>
<script defer rel="prefetch" type="application/javascript" src="/static/js/board.js"></script>
</body>
</html>