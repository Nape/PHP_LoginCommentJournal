<?php
/**
 * Created by Nadir Pelletier.
 * For: TP4 POO III
 * Date: 2019-05-04
 * Time: 11:55 AM
 */

function login($connection)
{
    session_start();
    $titre = 'Login';
    $erreurs = array();
    $msgNomNull = "Vous devez entrer un nom d'utilisateur.";
    $msgMdpNull = "Vous devez entrer un mot de passe.";
    $msgNomExisteDeja = "Le nom d'utilisateur existe deja.";
    $msgExistePas = "La combinason nom / mot de passe est invalide.";



//    Verifie que l'on est en post.
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
//      Enregistrement nouvel utilisateur.
        if (isset($_POST['sub_nv']))
        {
            if (empty($_POST['nom']))
            {
                array_push($erreurs, $msgNomNull);
            }
            if (empty($_POST['mdp']))
            {
                array_push($erreurs, $msgMdpNull);
            }

            if (count($erreurs) == 0)
            {
//                Si le nom d'utilisateur n'existe pas, on ajoute
                if (!$connection->utisateurExiste($_POST['nom']))
                {
                    if ($connection->setUtilisateur($_POST['nom'], $_POST['mdp']))
                    {
                        $_SESSION['nom'] = $_POST['nom'];
                        $_SESSION['nouveau'] = true;
                        require('Vue/vueAcceuil.php');
                        require('Vue/vueLogin.php');
                        deconnexion();
                    } else
                    {
                        deconnexion();
                        require('Vue/vueLogin.php');
                    }
                } else
                {
                    array_push($erreurs, $msgNomExisteDeja);
                }
            } else
            {
                require('Vue/vueErreur.php');
                require('Vue/vueLogin.php');
            }
        } //        Connexion d'un utilisateur existant.
        elseif (isset($_POST['sub_connexion']))
        {

            if (empty($_POST['nom']))
            {
                array_push($erreurs, $msgNomNull);
            }
            if (empty($_POST['mdp']))
            {
                array_push($erreurs, $msgMdpNull);
            }
            if (count($erreurs) == 0)
            {
//               Si l'utilisateur existe.
                if ($connection->getUtilisateur($_POST['nom'], $_POST['mdp']))
                {
                    $_SESSION['nom'] = $_POST['nom'];
                    $_SESSION['connecte'] = true;
                    $_SESSION['commentaires'] = $connection->getCommentaires($_SESSION['nom'], $connection::Vieux);

                    require('Vue/vueJournal.php');
                }
                else
                {
                    array_push($erreurs, $msgExistePas);
                }

            } else
            {
                require('Vue/vueErreur.php');
                require('Vue/vueLogin.php');
            }
        }
    }
    else
    {
        if ($_SESSION['connecte'] === true)
        {
            $_SESSION['commentaires'] = $connection->getCommentaires($_SESSION['nom'], $connection::Nouveau);
            require('Vue/vueJournal.php');

        } else
        {
            require('Vue/vueLogin.php');
        }
    }

    return $erreurs;
}

function journal()
{
    if (isset($_POST['journal']))
    {
        require ('Vue/vueJournal.php');
    }
}