<?php
/**
* Test_db.php
*
* PHP file to test if the database is successfully connected
*
* PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
*
* @category Model
* @package  Model
* @author   isma91 <ismaydogmus@gmail.com>
* @author   Raph <rbleuzet@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     https://github.com/isma91/my_phpmyadmin/blob/master/install/test_db.php
*/
try {
    $bdd = new PDO("mysql:host=" . $_POST["host"] . ";dbname=" . $_POST["db_name"], $_POST["db_username"], $_POST["db_password"]);
    $requete_table = $bdd->query("SHOW TABLES");
    $donnees_table = $requete_table->fetchAll(PDO::FETCH_NUM);
    if (count($donnees_table) === 0) {
        echo "The database '" . $_POST["db_name"] . "' is empty !! You can finish the installation now !!\n";
    } else {
        echo "Error !! The database '" . $_POST["db_name"] . "' is not empty !!\n";
    }
} catch (PDOException $exception) {
    if ($exception->getCode() === 2005) {
        echo "Error !! The MySQL server '" . $_POST["host"] . "' is not recognized !!\n";
    } elseif ($exception->getCode() === 1045) {
        if ($_POST["db_password"] === "") {
            echo "Error !! The MySQL server denied acces to '" . $_POST["db_username"] . "', maybe you forgot to write the password ??\n";
        } else {
            echo "Error !! The MySQL server denied acces to '" . $_POST["db_username"] . "', maybe you have write the wrong password ??\n";
        }
    } elseif ($exception->getCode() === 1049) {
        echo "Error !! Database '" . $_POST["db_name"] . "' doesn't exist in the MySQL server '" . $_POST["host"] . "'\n";
    } else {    
        echo "Error !! " . $exception->getMessage();
    }
}
?>