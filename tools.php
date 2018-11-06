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

/**
 * @param $datetime
 * @return string
 */
function convertDatetimeToString($datetime)
{
    $result = new DateTime($datetime);
    $date = $result->format('d/m/Y');
    $hour = $result->format('H:i');

    return $date . ' à ' . $hour;
}