<?php
/**
 * Created by Nadir Pelletier.
 * For: TP4 POO III
 * Date: 2019-04-25
 * Time: 2:44 PM
 */


    session_start();
    ob_start();
    ?>

    <form action="index.php" method="post">
        <input type="submit" name="deconnexion" value="Déconnection"/>
    </form>
    <?php
    $deconnexion = ob_get_clean();
