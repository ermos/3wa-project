<header class="header">
	<div class="header__content">
		<a href="/"><h1 class="header__logo"><?= APP_NAME ?><span>.</span></h1></a>
		<nav class="header__nav">
			<a <?= isActivePage("Home") ?> href="/">Accueil</a>
			<a <?= isActivePage("Planning") ?> href="#">Planning</a>
			<a <?= isActivePage("Settings") ?> href="#">Paramètres</a>
			<a href="/?p=logout">Se déconnecter</a>
		</nav>
	</div>
</header>