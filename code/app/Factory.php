<?php
namespace App;

class Factory
{
	public static function getDbo()
	{
		$dbFactory = new \Joomla\Database\DatabaseFactory;

		$db = $dbFactory->getDriver(
		    'mysqli',
		     \App\Config::db()
		);

		return $db;
	}

	public static function getSession()
	{
		$session_factory = new \Aura\Session\SessionFactory;
		$session = $session_factory->newInstance($_COOKIE);

		return $session;
	}

	public static function getTemplate()
	{
    	return 'code/templates/admin2.php';
	}
}

