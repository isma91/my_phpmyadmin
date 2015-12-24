<?php
/**
* Index.php
*
* The index core of the project
*
* PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
*
* @category Controller
* @package  Controller
* @author   isma91 <ismaydogmus@gmail.com>
* @author   Raph <rbleuzet@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     https://github.com/isma91/my_phpmyadmin/blob/master/index.php
*/
session_start();
if (!file_exists('config.php')) {
    header('Location: ./install/');
} else {
    include './views/index.php';
}
require 'autoload.php';