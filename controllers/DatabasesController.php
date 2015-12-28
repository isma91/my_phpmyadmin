<?php
/**
* DatabasessController.php
*
* File who contain the Database class
*
* PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
*
* @category Controller
* @package  Controller
* @author   isma91 <ismaydogmus@gmail.com>
* @author   Raph <rbleuzet@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     https://github.com/isma91/my_phpmyadmin/blob/master/controllers/DatabasessController.php
*/
namespace controllers;
use models\Db;
use models\Database;
/**
* DatabasesController
*
* Class Databases
*
* PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
*
* @category Controller
* @package  Controller
* @author   isma91 <ismaydogmus@gmail.com>
* @author   Raph <rbleuzet@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     https://github.com/isma91/my_phpmyadmin/blob/master/controllers/DatabasesController.php
*/
class DatabasesController extends Database
{
    public function checkRight ()
    {
        if (file_exists('config.php')) {
            $config = include 'config.php';
        } else {
            $config = include '../config.php';
        }
        $db = new Db();
        if (!isset($_SESSION['id']) && !isset($_SESSION['token'])) {
            return 'false';
        }
        $get = $db->getDb()->prepare("SELECT * FROM mysql.user WHERE user = :username AND Host = :host");
        $get->bindParam(':username', $config['databases']['user']);
        $get->bindParam(':host', $config['databases']['host']);
        $get->execute();
        $user_db_right = $get->fetch(\PDO::FETCH_ASSOC);
        if ($user_db_right) {
            return json_encode($user_db_right);
        } else {
            return 'false';
        }
    }
    public function showDatabases ()
    {
        $db = new Db();
        if (!isset($_SESSION['id']) && !isset($_SESSION['token'])) {
            return 'false';
        }
        $get = $db->getDb()->prepare('SHOW DATABASES');
        $get->execute();
        $databases = $get->fetchAll(\PDO::FETCH_ASSOC);
        $allDatabases = array();
        if ($databases) {
            foreach ($databases as $database) {
                array_push($allDatabases, $database["Database"]);
            }
            return json_encode($allDatabases);
        } else {
            return 'false';
        }
    }
    public function showTables ($databaseName)
    {
        if (is_array($databaseName)) {
            $db = new Db();
            if (!isset($_SESSION['id']) && !isset($_SESSION['token'])) {
                return 'false';
            }
            $allTables = array();
            foreach ($databaseName as $database) {
                $get = $db->getDb()->prepare('SHOW TABLES FROM `' . $database . '`');
                // replace $databaseName by :databaseName
                //$get->bindParam(':databaseName', $databaseName);
                $get->execute();
                $tables = $get->fetchAll(\PDO::FETCH_ASSOC);
                if (is_array($tables)) {
                    if (empty($tables)) {
                        $allTables[$database] = array();
                    } else {
                        foreach ($tables as $table) {
                            $allTables[$database][] = $table["Tables_in_" . $database];
                        }
                    }
                } else {
                    return 'false';
                }
            }
            return json_encode($allTables);
        } else {
            return 'false';
        }
    }
    public function showColumns($databaseName, $tableName)
    {
        $db = new Db();
        if (!isset($_SESSION['id']) && !isset($_SESSION['token'])) {
            return 'false';
        }
        $get = $db->getDb()->prepare('SHOW COLUMNS FROM `' . $tableName . '` FROM `' . $databaseName . '`');
        $get->execute();
        $columns = $get->fetchAll(\PDO::FETCH_ASSOC);
        if ($columns) {
            return json_encode($columns);
        } else {
            return 'false';
        }
    }
    public function showTableStatus ($databaseName)
    {
        $db = new Db();
        if (!isset($_SESSION['id']) && !isset($_SESSION['token'])) {
            return 'false';
        }
        $get = $db->getDb()->prepare('SHOW TABLE STATUS FROM `' . $databaseName . '`');
        $get->execute();
        $status = $get->fetchAll(\PDO::FETCH_ASSOC);
        if ($status) {
            return json_encode($status);
        } else {
            return 'false';
        }
    }
}