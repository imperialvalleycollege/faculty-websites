<?php
namespace App\View;

class Instructor extends Base
{
	public function render()
	{

		//$this->setData('username', $this->model->getUsers());
		$this->setData('title', $this->model->getData()->sis_first_name . ' ' . $this->model->getData()->sis_last_name);
		//$this->setData('grouped', $this->model->group($this->data->users, 'starts_with'));

		$this->loadSubview('instructor');
	}

	public function getBaseRequestUri($includeTrailingSlash = true)
	{
		$baseUrlPath = \App\Config::templateBasePath() . $this->model->getData()->sis_username;
		if ($includeTrailingSlash)
		{
			$baseUrlPath = $baseUrlPath . '/';
		}

		return $baseUrlPath;
	}
}
