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
}

