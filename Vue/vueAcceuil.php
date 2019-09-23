<?php
/**
 * Created by Nadir Pelletier.
 * For: TP4 POO III
 * Date: 2019-04-21
 * Time: 11:20 PM
 */
ob_start();

if (isset($_SESSION['nouveau']))
{

    echo("<h1>Félicitation vous êtes maintenant inscrit !</h1> ");
    echo ("\n");
    echo("Voici votre nom d'utilisateur : " . $_SESSION['nom']);
    ?>

    <?php
    $messageInscription = ob_get_clean();

}
