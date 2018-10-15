<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 08/10/2018
 * Time: 09:05
 */

/**
 * @param $classname
 */
function loadClass($classname)
{
    require 'class/' . $classname . '.php';
}