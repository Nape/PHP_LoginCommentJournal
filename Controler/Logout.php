<?php
/**
 * Created by Nadir Pelletier.
 * For: TP4 POO III
 * Date: 2019-04-25
 * Time: 2:39 PM
 */
session_start();
function deconnexion()
{
    $deconnecte = false;

    //Si la session est active on la détruit.
    if (isset($_SESSION['connecte']))
    {
        unset($_SESSION);
        session_destroy();
        $deconnecte = true;
    }
    return $deconnecte;
}

function seDeconnecter()
{
    if (isset($_POST['deconnexion']) && deconnexion())
    {
        require('Vue/vueAcceuil.php');
        require('Vue/vueLogin.php');
    }
}