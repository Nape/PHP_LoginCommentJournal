<?php
/**
 * Created by Nadir Pelletier.
 * For: TP4 POO III
 * Date: 2019-04-20
 * Time: 9:03 AM
 */
$titre = "Login";
ob_start();
?>

<?php
?>

    <form action="index.php" method="post" class="form">
        <table class="center">
            <tr>
                <td ><label for="identifiant">Identifiant :</label></td>
                <td><input type="text" name="nom" id="nom" value="" required /></td>
            </tr>
            <tr>
                <td><label for="mdp">Mot de passe :</label></td>
                <td><input type="password" name="mdp" id="mdp" value="" required />
                </td>
            </tr>
        </table>
        <br />
        <div>
            <input type="submit" name="sub_nv" value="Nouvel utilisateur" />
            <input type="submit" name="sub_connexion" value="Connexion" />
        </div>
    </form>


<?php
$login = ob_get_clean();
require ('Vue/vueErreur.php');
require ('Vue/vueGabarit.php');
?>