<header class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Buyify</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="navbar-nav mr-auto">
            <a class="nav-item nav-link" href="/">Accueil</a>
        </div>
        <span class="header-buttons">
            <?php
            require_once('../model/Utilisateur.class.php');
            if (Utilisateur::isConnecte()):
            ?>
                <a href="deconnexion.ctrl.php"><button class="btn btn-primary">Déconnexion</button></a>
            <?php
            else:
            ?>
                <a href="inscription.ctrl.php"><button class="btn btn-secondary">Inscription</button></a>
                <a href="connexion.ctrl.php"><button class="btn btn-primary">Connexion</button></a>
            <?php
            endif;
            ?>
        </span>
    </div>
</header>
