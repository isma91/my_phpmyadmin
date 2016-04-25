<?php
/**
* Autoload.php
*
* A simple autoload
*
* PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
*
* @category Model
* @package  Model
* @author   isma91 <ismaydogmus@gmail.com>
* @author   Raph <rbleuzet@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     https://github.com/isma91/my_phpmyadmin/blob/master/autoload.php
*/
/**
* Autoload
*
* This function allows to not add include in every file
*
* PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
*
* @category Model
* @package  Model
* @param    String $class class you want to use
* @author   isma91 <ismaydogmus@gmail.com>
* @author   Raph <rbleuzet@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     https://github.com/isma91/my_phpmyadmin/blob/master/config_sample.php
* @return   nothing
*/
function autoload($class)
{
    $class = str_replace('\\', '/', $class);
    include $class . '.php';
}

spl_autoload_register('autoload');