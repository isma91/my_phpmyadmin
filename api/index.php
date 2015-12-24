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

//use controllers\BlogsController;

/*if (isset($_GET['blog'])) {
	$limit = (isset($_GET['limit']) && (is_int($_GET['limit']) || is_numeric($_GET['limit']))) ? $_GET['limit'] : 10;
	$o = new BlogsController();
	$blog = $o->getBlogBySlug($_GET['blog'], $limit);
}*/
?>