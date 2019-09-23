<?php
/**
 * Created by Nadir Pelletier.
 * For: TP4 POO III
 * Date: 2019-04-25
 * Time: 10:04 AM
 */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="Contenu/style.css?<?php echo time(); ?>"/>
    <title><?=$titre ?></title>
</head>

<body class="center" >
<!--<div class="center" >-->
    <header class="center">
       <H1> <?= $titre ?> </H1>
    </header>
    <div id="erreur"class="center">
        <?= $erreur?>
    </div>
    <div id="form-login"class="center">
        <?= $login ?>
    </div>
    <div id="contenu"class="center">
        <?= $journal ?>
    </div>
    <div id="messageInscription"class="center">
        <?= $messageInscription ?>
    </div>
    <div id="formDeconection"class="center">
        <?= $deconnexion ?>
    </div>
</body>
    <!-- #contenu -->
    <footer id="piedBlog"class="center"> TP4 Nadir Pelletier & Alix Lelièvre. </footer>
<!--</div>-->
<!--<!-- #global -->
</html>