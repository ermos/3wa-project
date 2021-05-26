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
		<form action="/create-room" method="post" class="block">
			<h2 class="create-room__title">Créer une chambre</h2>
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
</body>
</html>