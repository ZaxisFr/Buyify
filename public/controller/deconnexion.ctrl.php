<?php

session_start();
session_destroy();

header('Location: ' . $_SESSION['prevurl'] ?? 'connexion.ctrl.php');
