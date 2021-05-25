<?php
/**
 * @var array $data
 */
?>
<html>
<?php include "../src/ui/head.php" ?>
<body class="app">
<?php include "../src/ui/header.php" ?>
<div class="content content--small">
	<main class="main">
		<form action="?p=create-room" method="post" class="block">
			<h2 class="create-room__title">Poser une réservation</h2>
            <div class="booking__info">
                <h2 class="booking__title"><?= $data["room"]["name"] ?></h2>
                <p class="booking__type"><?= $data["room"]["type"] ?></p>
            </div>
            <div id="booking-calendar"></div>
			<label>
				<input
					class="input"
					type="text"
					placeholder="Nom de la chambre (Exemple : Numéro + Étage)"
					name="room_name"
				/>
			</label>
			<label>
				<select class="select" name="room_type">
					<option value="" disabled selected>Sélectionner un type de chambre</option>
					<?php foreach ($data["room_type"] as $rt) { ?>
						<option value="<?= $rt["id"] ?>"><?= $rt["name"] ?></option>
					<?php } ?>
				</select>
			</label>
			<?php if(!empty($data["error"])) { ?>
                <p class="popup popup--warning">
					<?= $data["error"] ?>
                </p>
			<?php } ?>
			<button class="btn btn--neutral" type="submit" name="submit">Créer</button>
		</form>
	</main>
</div>
<?php include "../src/ui/footer.php" ?>
<script type="application/javascript">
    const booking = JSON.parse('<?= str_replace("\\\"", "\"", addslashes(json_encode($data["room"]["booking"], JSON_HEX_TAG))) ?>')
</script>
<script defer rel="prefetch" type="application/javascript" src="/public/static/js/calendar.js"></script>
<script defer rel="prefetch" type="application/javascript" src="/public/static/js/booking.js"></script>
</body>
</html>