<?php
/**
 * Created by Nadir Pelletier.
 * For: TP4 POO III
 * Date: 2019-04-20
 * Time: 9:20 AM
 */
session_start();

if (count($_SESSION['erreurs']) > 0)
{
    ob_start();
    foreach ($erreurs as $erreur)
    {
        echo("<b>$erreur</b>");
    }
    $erreur = ob_get_clean();
    unset($_SESSION['errors']);
}


