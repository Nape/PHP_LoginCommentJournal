<?php
/**
 * Created by Nadir Pelletier.
 * For: TP4 POO III
 * Date: 2019-05-02
 * Time: 11:39 AM
 */


function autoloadConnection($class)
{
//    include 'Modele/' . $class . '.php';
    require( $class.'.php');

}


spl_autoload_register('autoloadConnection');

