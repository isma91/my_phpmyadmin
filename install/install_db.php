<?php
/**
* Install_db.php
*
* PHP file to create a database
*
* PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
*
* @category Model
* @package  Model
* @author   isma91 <ismaydogmus@gmail.com>
* @author   Raph <rbleuzet@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     https://github.com/isma91/my_phpmyadmin/blob/master/install/install_db.php
*/
$duplicate_database = false;
try {
    $bdd = new PDO("mysql:host=" . $_POST["host"] . ";", $_POST["db_username"], $_POST["db_password"]);
    $requete_database = $bdd->prepare("SHOW DATABASES;");
    $requete_database->execute();
    $donnees_database = $requete_database->fetchAll();
    foreach ($donnees_database as $value) {
        if ($value["Database"] === $_POST["db_name"]) {
            $duplicate_database = true;
            break;
        }
    }
    if ($duplicate_database === true) {
        echo "Error !! The database '" . $_POST["db_name"] . "' already exist !!\n";
    } else {
        $bdd->exec("CREATE DATABASE IF NOT EXISTS `" . $_POST["db_name"] . "`;");
        echo "Database '" . $_POST["db_name"] . "' successfully created !!\n";
    }
} catch (PDOException $exception) {
    if ($exception->getCode() === 2005) {
        echo "Error !! The MySQL server '" . $_POST["host"] . "' is not recognized !!\n";
    } elseif ($exception->getCode() === 1045) {
        if ($_POST["password"] === "") {
            echo "Error !! The MySQL server denied acces to '" . $_POST["db_username"] . "', maybe you forgot to write the password ??\n";
        } else {
            echo "Error !! The MySQL server denied acces to '" . $_POST["db_username"] . "', maybe you have write the wrong password ??\n";
        }
    } else {    
        echo "Error !! " . $exception->getMessage();
    }
}
?>