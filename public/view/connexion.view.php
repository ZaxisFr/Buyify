<div id="connexion-body" class="container_fluid">
    <?php if (isset($erreur)): ?>
        <p class="bg-danger banner"><?= $erreur ?> <button type="button" class="close" aria-label="close"><span aria-hidden="true">&times;</span></button></p>
    <?php endif; ?>

        <article class="card-body mx-auto" style="max-width: 400px;">
            <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <span class="fa fa-envelope"></span> </span>
                    </div>
                    <label class="d-none" for="mail">Adresse email</label>
                    <input id="mail" name="mail" class="form-control" placeholder="Adresse email" type="email" required>
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <span class="fa fa-lock"></span> </span>
                    </div>
                    <label class="d-none" for="mdp">Mot de passe</label>
                    <input id="mdp" name="mdp" class="form-control" placeholder="Mot de passe" type="password" required>
                </div>
                <div class="form-group">
                    <button name="connexion" type="submit" class="btn btn-primary btn-block"> Connectez-vous  </button>
                </div>
                <p class="text-center">Vous n'êtes pas inscrit ? <a href="inscription.ctrl.php">Inscrivez-vous</a> </p>
            </form>
        </article>
</div>
