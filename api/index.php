<?php
/**
* Index.php
*
* The api who all ajax request gonna go
*
* PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
*
* @category Controller
* @package  Controller
* @author   isma91 <ismaydogmus@gmail.com>
* @author   Raph <rbleuzet@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     https://github.com/isma91/my_phpmyadmin/blob/master/api/index.php
*/
session_start();
require './../autoload.php';
use controllers\UsersController;
use controllers\DatabasesController;
if (isset($_GET['checkRight'])) {
    echo DatabasesController::checkRight();
}
if (isset($_GET['logout'])) {
    if (isset($_SESSION['token']) && $_SESSION['token'] == $_GET['token']) {
        session_destroy();
        //header('Location: ./');
    }
}
/*if (isset($_GET['register'])) {
    $o = new UsersController();
    if ($o->create($_POST["username"], $_POST["lastname"], $_POST["firstname"] , $_POST["email"], $_POST["password"], $_POST["confirm_password"], $_POST["email"])) {
        $o->connection($_POST['username'], $_POST['password']);
    }
    $error_sign_up = $o->getError();
}*/
if (isset($_GET['connected'])) {
    $connected = UsersController::isConnected();
    if ($connected) {
        echo json_encode(array('connected' => true, 'id' => $_SESSION['id'], 'token' => $_SESSION['token'], 'name' => $_SESSION['name']));
    } else {
        echo json_encode(array('connected' => false));
    }
}
?>