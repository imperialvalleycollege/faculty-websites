<?php
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->get('/', function (ServerRequestInterface $request, ResponseInterface $response) {
    // Use the PSR 7 $request object

	$title = 'Homepage';

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
