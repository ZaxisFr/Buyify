<div id="inscription-body" class="container_fluid">
    <?php if (isset($erreur)): ?>
        <p class="bg-danger banner"><?= $erreur ?> <button type="button" class="close" aria-label="close"><span aria-hidden="true">&times;</span></button></p>
    <?php endif; ?>

    <?php if (isset($succes)): ?>
        <p class="bg-success banner">Votre compte a été créé. <button type="button" class="close" aria-label="close"><span aria-hidden="true">&times;</span></button></p>
    <?php endif; ?>

    <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
        <?php $classes = 'col-lg-6 col-md-6 col-sm-12 col-xs-12'; ?>
        <div class="row">
            <label class="<?= $classes ?>" for="nom">Nom :</label>
            <input class="<?= $classes ?>" type="text" name="nom" id="nom" required />
        </div>

        <div class="row">
            <label class="<?= $classes ?>" for="prenom">Prénom :</label>
            <input class="<?= $classes ?>" type="text" name="prenom" id="prenom" required />
        </div>

        <div class="row">
            <label class="<?= $classes ?>" for="mail">Adresse mail :</label>
            <input class="<?= $classes ?>" type="email" name="mail" id="mail" required />
        </div>

        <div class="row">
            <label class="<?= $classes ?>" for="mdp">Mot de passe :</label>
            <input class="<?= $classes ?>" type="password" name="mdp" id="mdp" required />
        </div>

        <div class="row">
            <label class="<?= $classes ?>" for="confirmation">Confirmation :</label>
            <input class="<?= $classes ?>" type="password" name="confirmation" id="confirmation" required />
        </div>

        <input type="submit" value="Envoyer" name="inscription" />
    </form>

</div>
