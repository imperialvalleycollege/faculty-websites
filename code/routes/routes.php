<?php
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->get('/', function (ServerRequestInterface $request, ResponseInterface $response) {
    // Use the PSR 7 $request object

	$response->write('Homepage!');

    return $response;
});

$app->get('/foo', function (ServerRequestInterface $request, ResponseInterface $response) {
    // Use the PSR 7 $request object

	$response->write('Hello!');
    return $response;
});
?>
