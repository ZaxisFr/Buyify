<div class="header-buttons">
    <?php

    if (isset($_SESSION['id'])):
    ?>
        <a href="deconnexion.ctrl.php"><button class="btn-primary">Déconnexion</button></a>
    <?php
    else:
    ?>
        <a href="inscription.ctrl.php"><button class="btn-secondary">Inscription</button></a>
        <a href="connexion.ctrl.php"><button class="btn-primary">Connexion</button></a>
    <?php
    endif;
    ?>
</div>
