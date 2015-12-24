<?php
/**
* Db.php
*
* To connect with the config file
*
* PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
*
* @category Model
* @package  Model
* @author   isma91 <ismaydogmus@gmail.com>
* @author   Raph <rbleuzet@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     https://github.com/isma91/my_phpmyadmin/blob/master/models/Db.php
*/
namespace models;
/**
* Db
*
* Class to connect with the database
*
* PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
*
* @category Model
* @package  Model
* @author   isma91 <ismaydogmus@gmail.com>
* @author   Raph <rbleuzet@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     https://github.com/isma91/my_phpmyadmin/blob/master/models/Db.php
*/
class Db
{
    private $_db;
    /**
    * Construct
    *
    * Directly connect with the db
    *
    * PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
    *
    * @category Model
    * @package  Model
    * @author   isma91 <ismaydogmus@gmail.com>
    * @author   Raph <rbleuzet@gmail.com>
    * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
    * @link     https://github.com/isma91/my_phpmyadmin/blob/master/models/Db.php
    */
    public function __construct()
    {
        if (!file_exists('./../config.php')) {
            throw new Exception("No config.php file in the root of the project", 1);
        } else {
            $config = include './../config.php';
        }
        $this->_db = new \PDO('mysql:host=' . $config['databases']['host'] . ';dbname=' . $config['databases']['dbname'], $config['databases']['user'], $config['databases']['password']);
    }
    /**
    * GetDb
    *
    * Function to get the \PDO to do some query
    *
    * PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
    *
    * @category Model
    * @package  Model
    * @author   isma91 <ismaydogmus@gmail.com>
    * @author   Raph <rbleuzet@gmail.com>
    * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
    * @link     https://github.com/isma91/my_phpmyadmin/blob/master/models/Database.php
    * @return   Object;
    */
    public function getDb()
    {
        return $this->_db;
    }
}