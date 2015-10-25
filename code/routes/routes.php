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
})->setName('home');

$app->get('/foo', function (ServerRequestInterface $request, ResponseInterface $response) {
    // Use the PSR 7 $request object

	$title = 'Foo';

	ob_start();
    include 'code/templates/admin2.php';

	$response->write(ob_get_clean());
    return $response;
});

$app->get('/login', function (ServerRequestInterface $request, ResponseInterface $response) {
    // Use the PSR 7 $request object

	//$title = 'Foo';

	ob_start();
    include 'code/templates/admin2_login.php';

	$response->write(ob_get_clean());
    return $response;
});

$app->get('/logout', function (ServerRequestInterface $request, ResponseInterface $response) {
    // Use the PSR 7 $request object

	$this->session->destroy();

	//$uri = $request->getUri()->withPath($this->router->pathFor('home'));
	return $response->withRedirect($this->router->pathFor('home'));
});

$app->post('/authenticate', function (ServerRequestInterface $request, ResponseInterface $response) {
    // Use the PSR 7 $request object

	if (!empty($_POST['email']) && !empty($_POST['password']))
	{
		$query = $this->db->getQuery(true);

		$query->select('*');
		$query->from('users');
		$query->where('email = ' . $this->db->quote($_POST['email']));

		$this->db->setQuery($query);

		$user = $this->db->loadObject();

		if (!empty($user))
		{
			if ($_POST['password'] === $user->password)
			{
				$segment = $this->session->getSegment('App\Authenticate');
				$segment->set('authenticated', 1);

				$uri = $request->getUri()->withPath($this->router->pathFor('home'));
				$pathForValue = $this->router->pathFor('home');
				return $response->withRedirect($this->router->pathFor('home'));
				//$response->write('<pre>' . 'Passwords Match!' . '</pre>');
				//$response->write('<pre>' . 'Authenticated Value: ' . $segment->get('authenticated') . '</pre>');
			}
			else
			{
				$response->write('<pre>' . 'Passwords Do Not Match!' . '</pre>');
				return $response->withRedirect('login');
			}
		}
		else
		{
			$response->write('<pre>' . 'User Does Not Exist' . '</pre>');
			return $response->withRedirect('login');
		}
		//$title = 'Foo';

		//ob_start();
	    //include 'code/templates/admin2_login.php';

		//$response->write(ob_get_clean());
		$response->write('<pre>'.print_r($_POST, true).'</pre>' . '<pre>'.print_r($user, true).'</pre>');
	    return $response;
	}
	else
	{
		$response->write('<pre>' . 'Email Address and Password Must Be Provided!' . '</pre>');
		return $response->withRedirect('login');
	}

});
