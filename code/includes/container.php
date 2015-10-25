<?php

$container = new \Slim\Container;

$container['db'] = function ($c) {
	// Make the database driver.
    $dbFactory = new \Joomla\Database\DatabaseFactory;

    $db = $dbFactory->getDriver(
        'mysqli',
        array(
            'host' => 'localhost',
            'user' => 'root',
            'password' => '',
            'port' => '3306',
            'database' => 'faculty-websites',
        )
    );
    return $db;
};
