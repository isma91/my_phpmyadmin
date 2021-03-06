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
* @author   Raph <rbleuzet@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     https://github.com/isma91/my_phpmyadmin/blob/master/api/index.php
*/
session_start();
require './../autoload.php';
use controllers\UsersController;
use controllers\DatabasesController;
if (isset($_GET['checkRight'])) {
    echo DatabasesController::checkRight();
} elseif (isset($_GET['showDatabases'])) {
    echo DatabasesController::showDatabases();
} elseif (isset($_GET['showTables']) && $_POST['arrayDatabase']) {
    echo DatabasesController::showTables($_POST['arrayDatabase']);
} elseif (isset($_GET['showColumns']) && $_POST['databaseName'] && $_POST['tableName']) {
    echo DatabasesController::showColumns($_POST['databaseName'], $_POST['tableName']);
} elseif (isset($_GET['showTableStatus']) && $_POST['databaseName']) {
    echo DatabasesController::showTableStatus($_POST['databaseName']);
} elseif (isset($_GET['connected'])) {
    $connected = UsersController::isConnected();
    if ($connected) {
        echo json_encode(array('connected' => true, 'id' => $_SESSION['id'], 'token' => $_SESSION['token'], 'username' => $_SESSION['username']));
    } else {
        echo json_encode(array('connected' => false));
    }
}
/*if (isset($_GET['register'])) {
    $o = new UsersController();
    if ($o->create($_POST["username"], $_POST["lastname"], $_POST["firstname"] , $_POST["email"], $_POST["password"], $_POST["confirm_password"], $_POST["email"])) {
        $o->connection($_POST['username'], $_POST['password']);
    }
    $error_sign_up = $o->getError();
}*/
?>