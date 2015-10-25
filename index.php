<?php

// Include the autoloader (which helps to autoload PHP classes on the fly):
require 'code/vendor/autoload.php';

// Include the container dependencies for our application:
require 'code/includes/container.php';

// Create an instance of the Slim Application:
$app = new \Slim\App($container);

// Include the routes for our application:
require 'code/routes/routes.php';

// Run the Application:
$app->run();
