<?php
/**
* Create_config.php
*
* PHP file to create the config file
*
* PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
*
* @category Model
* @package  Model
* @author   isma91 <ismaydogmus@gmail.com>
* @author   Raph <rbleuzet@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     https://github.com/isma91/my_phpmyadmin/blob/master/install/create_config.php
*/
$config = "<?php
/**
* Config.php
*
* File who have the username, password to connect to the MySQL server
* and the host and finally the database name for my_phpmyadmin
*
* PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
*
* @category Model
* @package  Model
* @author   isma91 <ismaydogmus@gmail.com>
* @author   Raph <rbleuzet@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     https://github.com/isma91/my_phpmyadmin/blob/master/config.php
* @return   array
*/
return [
    'databases' => [
        'host' => '" . $_POST["host"] . "',
        'dbname' => '" . $_POST["db_name"] . "',
        'user' => '" . $_POST["db_username"] . "',
        'password' => '" . $_POST["db_password"] . "',
    ],
];";
$config_file = file_put_contents("../config.php", $config);
echo $config_file;
?>