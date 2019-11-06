<?php
    require_once '../model/Message.class.php';
    require_once('../model/Utilisateur.class.php');
    $nbMsg = Message::getNbMessagesNonLus();
?>
<header class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Buyify</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="navbar-nav mr-auto">
            <a class="nav-item nav-link" href="/">Accueil</a>
            <?php
            if (Utilisateur::isConnecte()):
            ?>
            <a class="nav-item nav-link" href="produitAjout.ctrl.php">Ajouter un produit</a>
            <a class="nav-item nav-link" href="mesProduits.ctrl.php">Mes produits</a>
            <?php
            endif;
            ?>
        </div>
        <span class="navbar-nav header-buttons">
            <?php
            if (Utilisateur::isConnecte()):
            ?>
                <a class="nav-item nav-link" href="favori.ctrl.php" data-toggle="tooltip" title="Favoris"><span class="fas fa-star"></span></a>
                <a class="nav-item nav-link" href="message.ctrl.php" data-toggle="tooltip" title="<?= $nbMsg ?> message(s) non lu(s)">
                    <span class="far fa-envelope"></span><span class="badge badge-light"><?= $nbMsg ?></span>
                </a>
                <a class="nav-item nav-link" href="deconnexion.ctrl.php" data-toggle="tooltip" title="Déconnexion"><span class="fas fa-sign-out-alt "></span></a>
            <?php
            else:
            ?>
                <a class="mr-2" href="inscription.ctrl.php"><button class="btn btn-secondary">Inscription</button></a>
                <a href="connexion.ctrl.php"><button class="btn btn-primary">Connexion</button></a>
            <?php
            endif;
            ?>
        </span>
    </div>
</header>
