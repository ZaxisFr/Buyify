<div id="connexion-body" class="container_fluid">
    <header>
        <h1>Connexion</h1>
    </header>

    <?php if (isset($erreur)): ?>
        <p class="bg-danger banner"><?= $erreur ?> <button type="button" class="close" aria-label="close"><span aria-hidden="true">&times;</span></button></p>
    <?php endif; ?>

    <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
        <?php $classes = 'col-lg-6 col-md-6 col-sm-12 col-xs-12'; ?>
        <div class="row">
            <label class="<?= $classes ?>" for="email">Adresse mail :</label>
            <input class="<?= $classes ?>" type="email" name="email" id="email" required />

        <div class="row">
            <label class="<?= $classes ?>" for="mdp">Mot de passe :</label>
            <input class="<?= $classes ?>" type="password" name="mdp" id="mdp" required />
        </div>

        <input type="submit" value="Envoyer" name="connexion" />
    </form>
</div>
