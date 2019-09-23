<?php
/**
 * Created by Nadir Pelletier.
 * For: TP4 POO III
 * Date: 2019-04-25
 * Time: 2:10 PM
 */
session_start();

date_default_timezone_set('America/New York');

//Vérifie que l'utilisateur est connecté.
if (isset($_SESSION['nom']))
{
    ob_start();
    $nomJournal = $_SESSION['nom'];

    $titre = "BIENVENU SUR VOTRE JOURNAL $nomJournal !";
    ?>
    <div class="">
        <form method="post">
            <input type='hidden' name='userid' value='<?= $_SESSION['nom']?>'>
            <input type='hidden' name='date' value='<?= date('Y-m-d H:i:s')?>'>
            <table class="tableCommentaire">
                <tr>
                    <textarea class="boite-commentaire" name='commentaire'></textarea><br>
                </tr>
                <tr>
                    <button type='submit' name='env_com'>Enregristré</button>
                </tr>
            </table>
        </form>
                <form method="post">
                    <table class="center">
                        <tr>
                            <b> Ordes des commentaires</b>
                        </tr>
                        <tr>
                            <td><button type="submit" name="ASC" value="ASC">Vieux en premier</td>
                            <td><button type="submit" name="DESC" value="DESC" checked> Nouveaux en premier</td>
                        </tr>
                    </table>
                </form>
    </div>
    <div>
        <?php

        foreach ($_SESSION['commentaires'] as $commentaire)
        {
            echo ('<div class="boite-commentaire">');
            echo ($commentaire['COMDATE']."<br>");
            echo ($commentaire['COMMENTAIRE']."<br>");
            ?>
            <form class="supprimer-form" method="post">
                <input type="hidden" name="COMID" value="<?=$commentaire['COMID'] ?>">
                <button type="submit" name="supprimer" value="suprimer">Suprimer</button>
            </form>
            <?php
            echo ('</div>');
        }
        ?>

    </div>
    <?php
    $journal = ob_get_clean();





}
require ('Vue/vueLogout.php');
require ('Vue/vueGabarit.php');




