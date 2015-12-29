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
require 'autoload.php';
if (!file_exists('config.php')) {
    header('Location: ./install/');
}
/**
* Redirect
*
* Function to include some file dynamically
*
* PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
*
* @category Controller
* @package  Controller
* @author   isma91 <ismaydogmus@gmail.com>
* @author   Raph <rbleuzet@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     https://github.com/isma91/my_phpmyadmin/blob/master/index.php
* @param    String $page_name the page you want to include
* @return   Object
*/
function redirect ($page_name)
{
    include "./views/" . $page_name . ".php";
}
use controllers\UsersController;
$connected = UsersController::isConnected();
if (isset($_GET['connection'])) {
    $o = new UsersController();
    echo $o->connection($_POST['username'], $_POST['password']);
} elseif (isset($_GET['logout']) && $_GET['token']) {
    if (isset($_SESSION['token']) && $_SESSION['token'] == $_GET['token']) {
        session_destroy();
        redirect('index');
    }
} elseif (isset($_GET["page"]) && $connected === "true") {
    redirect($_GET['page']);
} else {
    if ($connected === "true") {
        redirect('home');
    } else {
        redirect('index');
    }
}