<?php
/**
* Insert_db.php
*
* PHP file to add some table and create a user
*
* PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
*
* @category Model
* @package  Model
* @author   isma91 <ismaydogmus@gmail.com>
* @author   Raph <rbleuzet@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
*/
try {
	$birth_time = strtotime($_POST["birthdate"]);
	$birthdate = date('Y-m-d', $birth_time);
	$bdd = new PDO("mysql:host=" . $_POST["host"] . ";dbname=" . $_POST["db_name"], $_POST["db_username"], $_POST["db_password"]);
	$sql = "CREATE TABLE IF NOT EXISTS `user` (
		  `id` int(11) PRIMARY KEY NOT NULL,
		  `first_name` varchar(255) NOT NULL,
		  `last_name` varchar(255) NOT NULL,
		  `username` varchar(255) NOT NULL,
		  `birthdate` datetime NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;
		INSERT INTO `user`(`id`, `first_name`, `last_name`, `username`, `birthdate`)
		VALUES ('1','" . $_POST["first_name"] . "','" . $_POST["last_name"] . "','" . $_POST["username"] . "','" . $birthdate . "')";
		$create_tables = $bdd->exec($sql);
		if ($create_tables === 0) {
			echo "true";
		} else {
			echo "false";
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
	} elseif ($exception->getCode() === 1049) {
		echo "Error !! Database '" . $_POST["db_name"] . "' doesn't exist in the MySQL server '" . $host . "'\n";
	} else {    
		echo "Error !! " . $exception->getMessage();
	}
}
?>