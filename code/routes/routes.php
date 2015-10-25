<?php
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->get('/', function (ServerRequestInterface $request, ResponseInterface $response) {
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
	$title = 'Foo';

	ob_start();
    include 'code/templates/admin2.php';

	$response->write(ob_get_clean());
    return $response;
});

$app->get('/login', function (ServerRequestInterface $request, ResponseInterface $response) {

	ob_start();
    include 'code/templates/admin2_login.php';

	$response->write(ob_get_clean());
    return $response;
});

$app->get('/logout', function (ServerRequestInterface $request, ResponseInterface $response) {
	$this->session->destroy();
	return $response->withRedirect($this->router->pathFor('home'));
});

$app->post('/authenticate', function (ServerRequestInterface $request, ResponseInterface $response) {
	$segment = $this->session->getSegment('app');

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
				$segment->set('authenticated', 1);

				$segment->setFlash('message', 'Successfully Authenticated!');
				$segment->setFlash('message-status', 'success');
				return $response->withRedirect($this->router->pathFor('home'));
			}
			else
			{
				$segment->setFlash('message', 'Passwords Do Not Match.');
				$segment->setFlash('message-status', 'warning');
				return $response->withRedirect('login');
			}
		}
		else
		{
			$segment->setFlash('message', 'User Does Not Exist.');
			$segment->setFlash('message-status', 'warning');
			return $response->withRedirect('login');
		}
	}
	else
	{
		$segment->setFlash('message', 'Email Address and Password Must Be Provided.');
		$segment->setFlash('message-status', 'danger');
		return $response->withRedirect('login');
	}

});
