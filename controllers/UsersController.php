<?php
/**
* UsersController.php
*
* File who contain the User class
*
* PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
*
* @category Controller
* @package  Controller
* @author   isma91 <ismaydogmus@gmail.com>
* @author   Raph <rbleuzet@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     https://github.com/isma91/my_phpmyadmin/blob/master/controllers/UsersController.php
*/
namespace controllers;
use models\Db;
use models\User;
/**
* UsersController
*
* Class user
*
* PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
*
* @category Controller
* @package  Controller
* @author   isma91 <ismaydogmus@gmail.com>
* @author   Raph <rbleuzet@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     https://github.com/isma91/my_phpmyadmin/blob/master/controllers/UsersController.php
*/
class UsersController extends User
{
    private $_me;
    /**
    * Construct
    *
    * Function to directly get some info of the current user
    *
    * PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
    *
    * @category Controller
    * @package  Controller
    * @author   isma91 <ismaydogmus@gmail.com>
    * @author   Raph <rbleuzet@gmail.com>
    * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
    * @link     https://github.com/isma91/my_phpmyadmin/blob/master/controllers/UsersController.php
    * @return   Object;
    */
    public function __construct()
    {
        $this->_me = $this->get();
    }
    /**
    * SetMe
    *
    * Function to set an other user
    *
    * PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
    *
    * @category Controller
    * @package  Controller
    * @author   isma91 <ismaydogmus@gmail.com>
    * @author   Raph <rbleuzet@gmail.com>
    * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
    * @link     https://github.com/isma91/my_phpmyadmin/blob/master/controllers/UsersController.php
    * @param    String $me the user
    * @return   Object;
    */
    public function setMe($me)
    {
        $this->_me = $me;
    }
    /**
    * GetMe
    *
    * Function to get some info of the current user
    *
    * PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
    *
    * @category Controller
    * @package  Controller
    * @author   isma91 <ismaydogmus@gmail.com>
    * @author   Raph <rbleuzet@gmail.com>
    * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
    * @link     https://github.com/isma91/my_phpmyadmin/blob/master/controllers/UsersController.php
    * @return   Object;
    */
    public function getMe()
    {
        return $this->_me;
    }
    /*public function render()
    {
        if (isset($_POST['user_update'])) {
            $this->update($_POST['name'], $_POST['email'], $_POST['lastname'], $_POST['firstname']);
        }

        if (isset($_GET['user']) && isset($_GET['token']) && $_GET['user'] == 'delete') {
            if ($_GET['token'] == $_SESSION['token']) {
                $this->delete();
            }
        }
    }*/
    /**
    * IsConnected
    *
    * Function to know if the user is currently connected or not
    *
    * PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
    *
    * @category Controller
    * @package  Controller
    * @author   isma91 <ismaydogmus@gmail.com>
    * @author   Raph <rbleuzet@gmail.com>
    * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
    * @link     https://github.com/isma91/my_phpmyadmin/blob/master/controllers/UsersController.php
    * @return   String;
    */
    static public function isConnected()
    {
        $db = new Db();
        if (!isset($_SESSION['id']) && !isset($_SESSION['token'])) {
            return 'false';
        }
        $get = $db->getDb()->prepare('SELECT id, token, username FROM users WHERE id = :id AND token = :token');
        $get->bindParam(':id', $_SESSION['id']);
        $get->bindParam(':token', $_SESSION['token']);
        $get->execute();

        $user = $get->fetch(\PDO::FETCH_ASSOC);
        if ($user) {
            $_SESSION['username'] = $user['username'];
            return 'true';
        }
    }
    /**
    * Create
    *
    * Function to create a user
    *
    * PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
    *
    * @category Controller
    * @package  Controller
    * @author   isma91 <ismaydogmus@gmail.com>
    * @author   Raph <rbleuzet@gmail.com>
    * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
    * @link     https://github.com/isma91/my_phpmyadmin/blob/master/controllers/UsersController.php
    * @param    String $username   username of the new user
    * @param    String $last_name  lastname of the new user
    * @param    String $first_name firtname of the new user
    * @param    String $password   password of the new user
    * @param    String $birthdate  birthdate of the new user
    * @return   String;
    */
    public function create($username, $last_name, $first_name ,$password, $birthdate)
    {
        $db = new Db();
        $password = $this->_hashPassword($password);
        if (!$this->_updateCheckUsername($username)) {
            return 'false';
        }
        $create = $db->getDb()->prepare('INSERT INTO users (username, first_name, last_name, password, birthdate) VALUES (:username, :first_name, :last_name, :password, :birthdate)');
        $create->bindParam(':name', $username, \PDO::PARAM_STR, 16);
        $create->bindParam(':last_name', $last_name, \PDO::PARAM_STR, 50);
        $create->bindParam(':first_name', $first_name, \PDO::PARAM_STR, 50);
        $create->bindParam(':password', $password, \PDO::PARAM_STR, 255);
        $create->bindParam(':birthdate', $birthdate, \PDO::PARAM_STR, 60);
        if ($create->execute()) {
            return 'true';
        }
    }
    /**
    * Update
    *
    * Function to update some info of the user
    *
    * PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
    *
    * @category Controller
    * @package  Controller
    * @author   isma91 <ismaydogmus@gmail.com>
    * @author   Raph <rbleuzet@gmail.com>
    * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
    * @link     https://github.com/isma91/my_phpmyadmin/blob/master/controllers/UsersController.php
    * @param    String $username   username of the new user
    * @param    String $last_name  lastname of the new user
    * @param    String $first_name firtname of the new user
    * @param    String $birthdate  birthdate of the new user
    * @return   String;
    */
    public function update($username, $last_name, $first_name, $birthdate)
    {
        $db = new Db();
        if (!$this->_updateCheckUsername($username)) {
            return 'false';
        }
        $update = $db->getDb()->prepare('UPDATE users SET username = :username, birthdate = :birthdate, last_name = :last_name, first_name = :first_name WHERE id = :id AND token = :token');
        $update->bindParam(':username', $username, \PDO::PARAM_STR, 16);
        $update->bindParam(':birthdate', $birthdate, \PDO::PARAM_STR, 60);
        $update->bindParam(':las_tname', $last_name, \PDO::PARAM_STR, 60);
        $update->bindParam(':firs_tname', $first_name, \PDO::PARAM_STR, 60);
        $update->bindParam(':id', $_SESSION['id']);
        $update->bindParam(':token', $_SESSION['token']);
        if ($update->execute()) {
            //header('Location:./');
            return 'true';
        }
    }
    /**
    * UpdatePassword
    *
    * Function to change the current password of the user
    *
    * PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
    *
    * @category Controller
    * @package  Controller
    * @author   isma91 <ismaydogmus@gmail.com>
    * @author   Raph <rbleuzet@gmail.com>
    * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
    * @link     https://github.com/isma91/my_phpmyadmin/blob/master/controllers/UsersController.php
    * @param    String $new new pasword of the new user
    * @return   String;
    */
    public function updatePassword($new)
    {
        $db = new Db();

        $password = $this->_hashPassword($new);

        $update = $db->getBdd()->prepare('UPDATE users SET password = :password WHERE id = :id AND token = :token');
        $update->bindParam(':password', $password);
        $update->bindParam(':id', $_SESSION['id']);
        $update->bindParam(':token', $_SESSION['token']);
        if ($update->execute()) {
            return 'true';
        }
        return 'false';
    }
    /**
    * Delete
    *
    * Function to delete a user
    *
    * PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
    *
    * @category Controller
    * @package  Controller
    * @author   isma91 <ismaydogmus@gmail.com>
    * @author   Raph <rbleuzet@gmail.com>
    * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
    * @link     https://github.com/isma91/my_phpmyadmin/blob/master/controllers/UsersController.php
    * @return   String;
    */
    public function delete()
    {
        $db = new Db();
        $delete = $db->getDb()->prepare('DELETE from users WHERE id = :id AND token = :token');
        $delete->bindParam(':id', $_SESSION['id']);
        $delete->bindParam(':token', $_SESSION['token']);
        if ($delete->execute()) {
            session_destroy();
            //header('Location:./');
            return 'true';
        }
    }
    /**
    * Connection
    *
    * Function to connect a user
    *
    * PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
    *
    * @category Controller
    * @package  Controller
    * @author   isma91 <ismaydogmus@gmail.com>
    * @author   Raph <rbleuzet@gmail.com>
    * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
    * @link     https://github.com/isma91/my_phpmyadmin/blob/master/controllers/UsersController.php
    * @param    String $username username of the new user
    * @param    String $password password of the new user
    * @return   String;
    */
    public function connection($username, $password)
    {
        $db = new Db();
        $getUser = $db->getDb()->prepare('SELECT id, username, password FROM users WHERE username = :username');
        $getUser->bindParam(':username', $username, \PDO::PARAM_STR);
        $getUser->execute();
        $user = $getUser->fetch(\PDO::FETCH_ASSOC);
        $hash = $user['password'];
        if (!$hash) {
            return 'false';
        }
        if (!$this->_checkPassword($password, $hash)) {
            return 'false';
        }
        $this->_updateToken($user['id']);
        $_SESSION['username'] = $user['username'];
        return 'true';
    }
    /**
    * Get
    *
    * Function to get some info to the user
    *
    * PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
    *
    * @category Controller
    * @package  Controller
    * @author   isma91 <ismaydogmus@gmail.com>
    * @author   Raph <rbleuzet@gmail.com>
    * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
    * @link     https://github.com/isma91/my_phpmyadmin/blob/master/controllers/UsersController.php
    * @return   Array;
    */
    public function get()
    {
        $db = new Db();
        $getUser = $db->getDb()->prepare('SELECT last_name, first_name, username, birthdate FROM users WHERE id = :id AND token = :token');
        $getUser->bindParam(':id', $_SESSION['id']);
        $getUser->bindParam(':token', $_SESSION['token']);
        $getUser->execute();
        $user = $getUser->fetch(\PDO::FETCH_ASSOC);
        if ($user) {
            return $user;
        }
        return 'false';
    }
    /**
    * GetUserById
    *
    * Function to have some info of a user
    *
    * PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
    *
    * @category Controller
    * @package  Controller
    * @author   isma91 <ismaydogmus@gmail.com>
    * @author   Raph <rbleuzet@gmail.com>
    * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
    * @link     https://github.com/isma91/my_phpmyadmin/blob/master/controllers/UsersController.php
    * @param    Integer $id id of the user
    * @return   Array;
    */
    public function getUserById($id)
    {
        $db = new Db();
        $getUser = $db->getDb()->prepare('SELECT last_name, first_name, username, birthdate FROM users WHERE id = :id');
        $getUser->bindParam(':id', $id);
        $getUser->execute();
        $user = $getUser->fetch(\PDO::FETCH_ASSOC);
        if ($user) {
            return $user;
        }
        return 'false';
    }
    /**
    * UpdateToken
    *
    * Function to set a new token to the user
    *
    * PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
    *
    * @category Controller
    * @package  Controller
    * @author   isma91 <ismaydogmus@gmail.com>
    * @author   Raph <rbleuzet@gmail.com>
    * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
    * @link     https://github.com/isma91/my_phpmyadmin/blob/master/controllers/UsersController.php
    * @param    Integer $id id of the user
    * @return   String;
    */
    private function _updateToken($id)
    {
        $db = new Db();
        $token = sha1(time() * rand(1, 555));
        $updateToken = $db->getDb()->prepare('UPDATE users SET token = :token WHERE id = :id');
        $updateToken->bindParam(':token', $token, \PDO::PARAM_STR, 60);
        $updateToken->bindParam(':id', $id);
        if ($updateToken->execute()) {
            $_SESSION['token'] = $token;
            $_SESSION['id'] = $id;
            return 'true';
        }
    }
    /**
    * HashPassword
    *
    * Function to hash the user's password
    *
    * PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
    *
    * @category Controller
    * @package  Controller
    * @author   isma91 <ismaydogmus@gmail.com>
    * @author   Raph <rbleuzet@gmail.com>
    * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
    * @link     https://github.com/isma91/my_phpmyadmin/blob/master/controllers/UsersController.php
    * @param    String $password the user's passwors 
    * @return   String;
    */
    private function _hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    /**
    * CheckPassword
    *
    * Function to check if the password is the same as in the database
    *
    * PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
    *
    * @category Controller
    * @package  Controller
    * @author   isma91 <ismaydogmus@gmail.com>
    * @author   Raph <rbleuzet@gmail.com>
    * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
    * @link     https://github.com/isma91/my_phpmyadmin/blob/master/controllers/UsersController.php
    * @param    String $password the password of the user
    * @param    String $hash     the hashed password of the user
    * @return   boolean;
    */
    private function _checkPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }
    /**
    * UpdateCheckUsername
    *
    * Function to check if the username is taken or not
    *
    * PHP Version 5.6.14-0+deb8u1 (cli) (built: Oct  4 2015 16:13:10)
    *
    * @category Controller
    * @package  Controller
    * @author   isma91 <ismaydogmus@gmail.com>
    * @author   Raph <rbleuzet@gmail.com>
    * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
    * @link     https://github.com/isma91/my_phpmyadmin/blob/master/controllers/UsersController.php
    * @param    String $username username
    * @return   Boolean;
    */
    private function _updateCheckUsername($username)
    {
        $db = new Db();
        //$id = (isset($_SESSION['id'])) ? $_SESSION['id'] : 0;
        if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
        } else {
            $id = 0;
        }
        $check = $db->getDb()->prepare('SELECT * FROM users WHERE username = :username AND id != :id');
        $check->bindParam(':username', $username, \PDO::PARAM_STR, 16);
        $check->bindParam(':id', $id);
        $check->execute();
        $user = $check->fetch(\PDO::FETCH_ASSOC);
        if ($user) {
            return false;
        }
        return true;
    }
}