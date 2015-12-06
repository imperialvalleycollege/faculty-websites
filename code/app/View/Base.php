<?php
namespace App\View;

class Base
{
	protected $data;
	protected $model;
	protected $response;
	protected $request;

	public function __construct()
	{
		$this->data = new \stdClass;
	}

	public function setResponse(\Psr\Http\Message\ResponseInterface $response)
	{
		$this->response = $response;
	}

	public function setRequest(\Psr\Http\Message\RequestInterface $request)
	{
		$this->request = $request;
	}

	public function getBaseRequestUri()
	{
		return \App\Config::templateBasePath();
	}

	public function setData($key, $data)
	{
		$this->data->$key = $data;
	}

	public function setModel(\App\Model\Base $model)
	{
		$this->model = $model;
	}

	public function loadSubview($name = '')
	{
		if (!empty($name))
		{
			ob_start();
		    include __DIR__ . '/Subview/' . $name . '.php';
			$body = ob_get_clean();
		}

		ob_start();
		include \App\Factory::getTemplate();
		$this->response->write(ob_get_clean());
	}

	public function loadPartial($name = '')
	{
		if (!empty($name))
		{
			ob_start();
		    include __DIR__ . '/Subview/' . $name . '.php';
			echo ob_get_clean();
		}
	}

	public function loadMenu($name = '')
	{
		if (!empty($name))
		{
			ob_start();
		    include __DIR__ . '/Menu/' . $name . '.php';
			$this->menu = ob_get_clean();
		}
	}
}
