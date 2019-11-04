<?php

require_once('../../framework/View.class.php');
require_once('../model/Utilisateur.class.php');
require_once('../model/Message.class.php');
require_once ('_base.ctrl.php');

session_start();
if (!Utilisateur::isConnecte()) {
    header('Location: connexion.ctrl.php');
}

$messages = Message::getListeMessages();

$view = new View();
$view->assign('conversations', $messages);
$view->setTitle('Messages privés');
$view->display('message.view.php');
