<?php
/**
 * Created by Nadir Pelletier.
 * For: TP4 POO III
 * Date: 2019-04-20
 * Time: 9:00 AM
// */

session_start();

require_once ('Modele/autoload.php');
require('Controler/Login.php');
require('Controler/Erreurs.php');
require_once('Controler/Logout.php');
require ('Controler/Commentaires.php');

autoloadConnection(ConnectionBD::class);
$connection = new ConnectionBD();



supressionCommentaire($connection);
ascCommentaires($connection);
descCommentaires($connection);
seDeconnecter();
journal();
$_SESSION['erreurs'] = login($connection);
nouveauCommentaire($connection);
afficherErreurs($_SESSION['erreurs']);

?>










