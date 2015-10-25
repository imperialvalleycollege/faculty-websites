<?php
// Include the autoloader (which helps to autoload PHP classes on the fly):
require '../vendor/autoload.php';

use Aura\Cli\CliFactory;
use Aura\Cli\Status;

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

// get the context and stdio objects
$cli_factory = new CliFactory;
$context = $cli_factory->newContext($GLOBALS);
$stdio = $cli_factory->newStdio();

// define options and named arguments through getopt
$options = ['verbose,v'];
$getopt = $context->getopt($options);

// do we have a name to say hello to?
$name = $getopt->get(1);
if (! $name) {
    // print an error
    $stdio->errln("Please give a name to say hello to.");
    exit(Status::USAGE);
}

// say hello
if ($getopt->get('--verbose')) {
    // verbose output
    $stdio->outln("Hello {$name}, it's nice to see you!");
} else {
    // plain output
    $stdio->outln("Hello {$name}!");
}

$query = $db->getQuery(true);

$query->select('*');
$query->from('api');

$db->setQuery($query);

$rows = $db->loadObjectList();

foreach($rows as $row)
{
	$stdio->outln($row->organization);
}

// done!
exit(Status::SUCCESS);
