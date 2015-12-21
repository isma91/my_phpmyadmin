<?php
session_start();
if (!file_exists('config.php')) {
	header('Location: ./install/');
}
require 'autoload.php';