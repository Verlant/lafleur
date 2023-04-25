<?php

/**
 * autoloader des classes de controleurs et modèles
 * @param String $class
 */
function my_autoloader(String $class)
{
    if (substr($class, 0, 2) == 'M_') {
        include_once 'App/model/' . $class . '.php';
    } else {
        include_once 'App/controller/' . $class . '.php';
    }
}

/**
 * Appelle automatiquement ma fonction my_autoloader si besoin
 */
function autoLoad()
{
    spl_autoload_register('my_autoloader');
}