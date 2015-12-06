<?php
namespace App;

class Config
{
	public static function db()
	{
		return array(
	        'host' => 'localhost',
	        'user' => 'root',
	        'password' => '',
	        'port' => '3306',
	        'database' => 'faculty-websites',
	    );
	}

	public static function templateBasePath()
	{
		return '/' . basename(dirname(dirname(__DIR__))) . '/';
	}
}

