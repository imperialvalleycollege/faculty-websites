<?php
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;

$app->get('/', function (ServerRequestInterface $request, ResponseInterface $response) {

	$model = new \App\Model\Homepage;

	$view = new \App\View\Homepage;
	$view->setModel($model);
	$view->setResponse($response);

	$view->render();

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

$app->get('/manual-submission', function (ServerRequestInterface $request, ResponseInterface $response) {
	ob_start();
    include 'code/templates/admin2_submission.php';

	$response->write(ob_get_clean());
    return $response;
})->setName('manual-submission');

$app->group('/api/1.0', function () {
    $this->post('/submission', function (ServerRequestInterface $request, ResponseInterface $response) {
		$segment = $this->session->getSegment('app');

		if (!empty($_POST['organization']) && !empty($_POST['api_key']))
		{
			$query = $this->db->getQuery(true);

			$query->select('*');
			$query->from('api');
			$query->where('organization = ' . $this->db->quote($_POST['organization']));
			$query->where('api_key = ' . $this->db->quote($_POST['api_key']));

			$this->db->setQuery($query);

			$row = $this->db->loadObject();

			if (!empty($row))
			{
				if (isset($_FILES) && $_FILES['submission_file']['error'] === UPLOAD_ERR_OK)
				{
					// Handle File Upload Placement:

					// Create instance of Flysystem:
					$adapter = new Local(__DIR__.'/../files');
					$filesystem = new Filesystem($adapter);


					$stream = fopen($_FILES['submission_file']['tmp_name'], 'r+');
					$filename = date('Y-m-d_H-i-s') . '_' . $_POST['organization'] . '.txt';
					$result = $filesystem->writeStream('/' . $_POST['organization'] . '/' . $filename, $stream);
					fclose($stream);

					$fileUploadString = '';
					if ($result)
					{
						$mimetype = $filesystem->getMimetype('/' . $_POST['organization'] . '/' . $filename);
						if ($mimetype === "text/plain")
						{
							$fileUploadString = 'Successfully Uploaded File!<br />';
						}
						else
						{
							$filesystem->delete('/' . $_POST['organization'] . '/' . $filename);
							$fileUploadString = 'Deleted File...Incorrect Filetype!<br />';
						}
					}
					$response->write($fileUploadString . 'Success!<br />' . 'Org: ' . $_POST['organization'] . ' API Key: ' . $_POST['api_key']);
				}
				else
				{
					$segment->setFlash('message', 'Bad File Provided.');
					$segment->setFlash('message-status', 'danger');
					return $response->withRedirect($this->router->pathFor('manual-submission'));
				}
			}
			else
			{
				$segment->setFlash('message', 'Bad Organization Name or API Key Provided.');
				$segment->setFlash('message-status', 'danger');
				return $response->withRedirect($this->router->pathFor('manual-submission'));
			}
		}
	});
});

$app->get('/{username}', function (ServerRequestInterface $request, ResponseInterface $response, $args) {
	$username = $args['username'];

	$model = new \App\Model\Instructor($username);
	if ($model->isValid())
	{
		$view = new \App\View\Instructor;
		//$view->setData('title', $username);
		$view->setData('instructor', $username);
		$view->setModel($model);
		$view->setRequest($request);
		$view->setResponse($response);

		$view->render();

	    return $response;
	}
	else
	{
		// Doesn't actually get displayed
		//$segment = $this->session->getSegment('app');
		//$segment->setFlash('message', 'Invalid Instructor');
		//$segment->setFlash('message-status', 'warning');
		return $response->withRedirect($this->router->pathFor('home'))->withStatus(303);
	}

});

$app->get('/{username}/{course}', function (ServerRequestInterface $request, ResponseInterface $response, $args) {
	$username = $args['username'];
	$course = $args['course'];

	$model = new \App\Model\Instructor($username);
	if ($model->isValid())
	{
		$view = new \App\View\Course;
		$view->setData('title', strtoupper(str_replace('-', ' ', $course)));
		$view->setData('instructor', $username);
		$view->setModel($model);
		$view->setRequest($request);
		$view->setResponse($response);

		$view->render();

	    return $response;
	}
	else
	{
		// Doesn't actually get displayed
		//$segment = $this->session->getSegment('app');
		//$segment->setFlash('message', 'Invalid Instructor');
		//$segment->setFlash('message-status', 'warning');
		return $response->withRedirect($this->router->pathFor('home'))->withStatus(303);
	}

});