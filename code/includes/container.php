<?php

$container = new \Slim\Container;

$container['db'] = function ($c) {

    $db = \App\Factory::getDbo();

    return $db;
};

$container['session'] = function ($c) {
	$session = \App\Factory::getSession();
	return $session;
};
