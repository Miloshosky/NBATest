<?php

ob_start();
session_start();

define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', 'alek');
define('DBNAME', 'nba');

$db = new PDO("mysql:host=".DBHOST.";port=8889;dbname=".DBNAME,DBUSER,DBPASS);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

spl_autoload_register(function ($class)
{
	$class = strtolower($class);

	$classpath = 'classes/class.' . $class . '.php';
	if(file_exists($classpath))
	{
		require_once $classpath;
	}
	
	$classpath = '../classes/class.' . $class . '.php';
	if(file_exists($classpath))
	{
		require_once $classpath;
	}

	$classpath = '../../classes/class.' . $class . '.php';
	if(file_exists($classpath))
	{
		require_once $classpath;
	} 
});

$user = new User($db);

?>