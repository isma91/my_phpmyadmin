<?php
/**
* Models.php
*
* The Models class
*
* PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
*
* @category Model
* @package  Model
* @author   isma91 <ismaydogmus@gmail.com>
* @author   Raph <rbleuzet@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     https://github.com/isma91/my_phpmyadmin/blob/master/models/Models.php
*/
namespace models;
/**
* Models.php
*
* The mother class Models
*
* PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
*
* @category Model
* @package  Model
* @author   isma91 <ismaydogmus@gmail.com>
* @author   Raph <rbleuzet@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     https://github.com/isma91/my_phpmyadmin/blob/master/models/Models.php
*/
class Models
{
    private $_error;
    /**
    * SetError
    *
    * To change the error
    *
    * PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
    *
    * @category Model
    * @package  Model
    * @param    String $error the error
    * @author   isma91 <ismaydogmus@gmail.com>
    * @author   Raph <rbleuzet@gmail.com>
    * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
    * @link     https://github.com/isma91/my_phpmyadmin/blob/master/models/Models.php
    * @return   nothing
    */
    public function setError($error)
    {
        $this->_error = $error;
    }
    /**
    * SetError
    *
    * To get the error
    *
    * PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
    *
    * @category Model
    * @package  Model
    * @author   isma91 <ismaydogmus@gmail.com>
    * @author   Raph <rbleuzet@gmail.com>
    * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
    * @link     https://github.com/isma91/my_phpmyadmin/blob/master/models/Models.php
    * @return   error
    */
    public function getError()
    {
        return $this->_error;
    }
}