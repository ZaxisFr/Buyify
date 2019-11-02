<?php

require_once('_base.ctrl.php');
require_once '../../framework/View.class.php';

$view = new View();

if(isset($_GET['msg'])){
    $view->assign("msg",$_GET['msg']);
}

if(isset($_GET['error'])){
    $view->assign("error",$_GET['error']);
} else {
    $view->assign("error","500");
    $view->assign("msg","Ooups c'est tout cassé, Mais vous n'y êtes pour rien !");
}



$view->setTitle('Buyify');
$view->display('error/erreurPage.err.php');
