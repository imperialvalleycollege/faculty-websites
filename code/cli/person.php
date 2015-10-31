<?php
// Include the autoloader (which helps to autoload PHP classes on the fly):
require '../vendor/autoload.php';

use Aura\Cli\CliFactory;
use Aura\Cli\Status;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;

$db = \App\Factory::getDbo();

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

} else {
    // plain output
    $stdio->outln("Hello {$name}!");
}

// Create instance of Flysystem:
/*$adapter = new Local(__DIR__.'/../files');
$filesystem = new Filesystem($adapter);

$paths = $adapter->listPaths();

foreach ($paths as $path) {
    $stdio->outln($path);
}*/

$filesFolder = __DIR__.'/../files';
foreach (new DirectoryIterator($filesFolder) as $fileInfo) {
    if($fileInfo->isDot()) continue;

    if ($fileInfo->isDir())
    {
		$organization = $fileInfo->getFilename();
		$organizationFolder = $filesFolder . '/' . $organization;
		foreach (new DirectoryIterator($organizationFolder) as $subFileInfo)
		{
			if($subFileInfo->isDot()) continue;
			$stdio->outln($subFileInfo->getFilename());

			//$contents = file_get_contents($subFileInfo->getPath() . '/' . $subFileInfo->getFilename());

			$importFile = $subFileInfo->getPath() . '/' . $subFileInfo->getFilename();

			if(($handle = fopen($importFile, 'r')) !== false)
			{
			    // get the first row, which contains the column-titles (if necessary)
			    $headers = fgetcsv($handle, null, '|');

				$importType = \App\Import\Helper::importType($headers);

				if (!empty($importType))
				{
					$importObject = \App\Import\Helper::createImportObject($importType);

					$importObject->setHeaders($headers);
				    $stdio->outln($importType);



				    // loop through the file line-by-line
				    while(($data = fgetcsv($handle, null, '|')) !== false)
				    {
			    		$stdio->outln(print_r($data, true));
						$importObject->setData($data);

						$result = $importObject->store();
				        // resort/rewrite data and insert into DB here
				        // try to use conditions sparingly here, as those will cause slow-performance

				        // I don't know if this is really necessary, but it couldn't harm;
				        // see also: http://php.net/manual/en/features.gc.php
				        unset($data);
				    }
				}
				else
				{
					$stdio->outln('Could not automatically determine import type. Please check header fields in: ' . $subFileInfo->getFilename());
				}

			    fclose($handle);

			    unlink($importFile);
			}

			//echo $contents;
		}

		rmdir($organizationFolder);
    }

}



$query = $db->getQuery(true);

$query->select('*');
$query->from('api');

$db->setQuery($query);

$rows = $db->loadObjectList();

foreach($rows as $row)
{
	//$stdio->outln($row->organization);
}


// done!
exit(Status::SUCCESS);
