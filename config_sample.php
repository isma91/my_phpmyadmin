<?php
/**
* Config_Sample.php
*
* This is a sample to the config file, if you install the project and finish
* the installation and the config file wasn't created you can use this file,
* just rename it to 'config.php' and add the host, user and password to connect
* to the MySQL server and the database name
*
* PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
*
* @category Model
* @package  Model
* @author   isma91 <ismaydogmus@gmail.com>
* @author   Raph <rbleuzet@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     https://github.com/isma91/my_phpmyadmin/blob/master/config_sample.php
* @return   array
*/
return [
    'databases' => [
        'host' => 'localhost',
        'dbname' => 'my_phpmyadmin',
        'user' => 'root',
        'password' => '',
    ],
];