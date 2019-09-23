<?php
/**
 * Created by Nadir Pelletier.
 * For: TP4 POO III
 * Date: 2019-05-04
 * Time: 11:56 AM
 *
 */

function afficherErreurs($erreurs)
{
    $_SESSION['erreurs'] = $erreurs;
    if (count($_SESSION['erreurs']) > 0)
    {
        require('Vue/vueLogin.php');
    }

}