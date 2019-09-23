<?php
/**
 * Created by Nadir Pelletier.
 * For: TP4 POO III
 * Date: 2019-05-04
 * Time: 12:15 PM
 */

session_start();

function nouveauCommentaire($connection)
{
    if (isset($_POST['env_com']))
    {
        $connection->setCommentaire($_SESSION['nom'], $_POST['date'], $_POST['commentaire']);
        $_SESSION['commentaires'] = $connection->getCommentaires($_SESSION['nom'], $connection::Nouveau);

//        ICI POUR EVITER LE «POST ON REFRESH» ON À 4 SOLUTIONS;

//        PREMIÈRE: Redirigé vers l'index(effet reset sur le POST)
//                  Cette solution n'expose pas la structure de notre site puisque
//                  l'index est connu de l'utilisateur
//                   header("Location: index.php");

//        DEUXIÈME: Avant d'ajouter un commentaire faire une verification sur :
//                  l'id -> Utilisateur et le timestamp -> Commentaire
//                  si l'id utilisateur et le timestamp sont Égaux
//                  on ajoute pas le commentaire.
//                  (Il serait étonnant qu'un utilisateur puisse envoyer 2 commentaires en moins d'une seconde.)

//        TROISIÈME: Un trigger ON INSERT directement sur la base de données qui effectu le meme traitement
//                   que l'option 2. L'inconveniant est que la base de données est sollicité à chaque repost.
//
//
//       
        require ('Vue/vueJournal.php');
    }
}

function supressionCommentaire($connection)
{
    if (isset($_POST['supprimer']))
    {
        $connection->suprimerCommentaire($_SESSION['nom'],$_POST['COMID']);
        $_SESSION['commentaires'] = $connection->getCommentaires($_SESSION['nom'],$connection::Nouveau);
        require ('Vue/vueJournal.php');
    }
}

function ascCommentaires($connection)
{
    if (isset($_POST['ASC']))
    {
        $_SESSION['commentaires'] = $connection->getCommentaires($_SESSION['nom'],$connection::Vieux);
        require ('Vue/vueJournal.php');
    }
}

function descCommentaires($connection)
{
    if (isset($_POST['DESC']))
    {
        $_SESSION['commentaires'] = $connection->getCommentaires($_SESSION['nom'],$connection::Nouveau);
        require ('Vue/vueJournal.php');
    }

}

