<?php
/**
 * @var array $data
 */
?>
<html>
<?php include "../src/ui/head.php" ?>
<body class="app">
<?php include "../src/ui/header.php" ?>
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
        <?php $now = date('Y-m-d'); ?>
        <div class="block board__search">
            <p>Je recherche une</p>
            <select id="search-room-type" class="search__select">
                <option value="" selected></option>
                <?php foreach ($data["room_type"] as $rt) { ?>
                <option value="<?= $rt["id"] ?>"><?= $rt["name"] ?></option>
                <?php } ?>
            </select>
            <select id="search-available" class="search__select">
                <option value="" selected></option>
                <option value="1">Disponible</option>
                <option value="0">Occupé</option>
            </select>
            <div id="search-date" class="search__hide">
                <p>entre</p>
                <input
                        id="search-date-min"
                        class="search__date"
                        type="date"
                        min="<?= $now ?>"
                        value="<?= $now ?>"
                >
                <p>et</p>
                <input
                        id="search-date-max"
                        class="search__date"
                        type="date"
                        min="<?= $now ?>"
                        value="<?= $now ?>"
                >
            </div>
        </div>
        <div id="room-list"></div>
    </main>
    <aside class="aside">
        <a href="?p=create-room" class="block block--no-bg board__add-room">
            <button class="btn btn--neutral add-room__btn">Ajouter une nouvelle chambre</button>
        </a>
    </aside>
</div>
<?php include "../src/ui/footer.php" ?>
<script defer rel="prefetch" type="application/javascript" src="/static/js/calendar.js"></script>
<script defer rel="prefetch" type="application/javascript" src="/static/js/board.js"></script>
</body>
</html>