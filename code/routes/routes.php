<?php
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->get('/', function (ServerRequestInterface $request, ResponseInterface $response) {
    // Use the PSR 7 $request object

	$title = 'Homepage';
	$query = $this->db->getQuery(true);

	$query->select('*');
	$query->from('users');

	$this->db->setQuery($query);

	$users = $this->db->loadObjectList();

	$body = print_r($users, true);

	ob_start();
    include 'code/templates/admin2.php';

	$response->write(ob_get_clean());

    return $response;
});

$app->get('/foo', function (ServerRequestInterface $request, ResponseInterface $response) {
    // Use the PSR 7 $request object

	$title = 'Foo';

	ob_start();
    include 'code/templates/admin2.php';

	$response->write(ob_get_clean());
    return $response;
});
?>
