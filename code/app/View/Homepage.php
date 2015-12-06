<?php
namespace App\View;

class Homepage extends Base
{
	public function render()
	{

		$this->setData('users', $this->model->getUsers());
		$this->setData('title', 'Instructors (' . count($this->data->users) . ')');
		$this->setData('grouped', $this->model->group($this->data->users, 'starts_with'));

		$this->loadSubview('homepage');
	}
}
