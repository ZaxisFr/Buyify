<div id="inscription-body" class="container_fluid">
    <?php if (isset($erreur)): ?>
        <p class="bg-danger banner"><?= $erreur ?> <button type="button" class="close" aria-label="close"><span aria-hidden="true">&times;</span></button></p>
    <?php endif; ?>

    <?php if (isset($succes)): ?>
        <p class="bg-success banner">Votre compte a été créé. <button type="button" class="close" aria-label="close"><span aria-hidden="true">&times;</span></button></p>
    <?php endif; ?>

    <article class="card-body mx-auto">
        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <span class="fa fa-user"></span> </span>
                </div>
                <label class="d-none" for="nom">Nom complet</label>
                <input id="nom" name="nom" class="form-control" placeholder="Nom complet" type="text" required>
            </div>
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
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <span class="fa fa-lock"></span> </span>
                </div>
                <label class="d-none" for="confirmation">Confirmation du mot de passe</label>
                <input id="confirmation" name="confirmation" class="form-control" placeholder="Confirmation du mot de passe" type="password" required>
            </div>
            <div class="form-group">
                <button name="inscription" type="submit" class="btn btn-primary btn-block"> Créez un compte  </button>
            </div>
            <p class="text-center">Vous possédez un compte ? <a href="connexion.ctrl.php">Connectez-vous</a> </p>
        </form>
    </article>
</div>
