<?php
/**
 * @var array $data
 */
?>
<html>
    <?php include "src/ui/head.php" ?>
    <body>
        <div id="signin">
            <div class="signin__left" style="background-image: url('/static/images/background/<?= rand(1, 10) ?>.png')">
                <div class="signin__logo"><h1>Hotelio</h1><p>Outils de réservation de chambre</p></div>
            </div>
            <div class="signin__right">
                <div class="signin__content">
                    <p class="signin__desc">Interface de réservation de chambre</p>
                    <h2 class="signin__title">Connectez-vous à votre compte</h2>
                    <form class="signin__form" method="post" action="">
                        <label>
                            <input
                                    class="input"
                                    type="text"
                                    placeholder="Nom d'utilisateur"
                                    name="username"
                                    value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>"
                            />
                        </label>
                        <label>
                            <input
                                    class="input"
                                    type="password"
                                    placeholder="Mot de passe"
                                    name="password"
                            />
                        </label>
                        <?php if(!empty($data["error"])) { ?>
                            <p class="popup popup--warning">
                                <?= $data["error"] ?>
                            </p>
                        <?php } ?>
                        <div class="btn-group">
                            <a href="#"><button class="btn btn--default">Mot de passe oublié ?</button></a>
                            <button class="btn btn--neutral" type="submit">Se connecter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
