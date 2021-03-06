<?php
namespace App\Import;

class Person implements ImportInterface
{
	public $table = 'sync_persons';
	public $organization = '';
	public $headers = array();
	public $data = array();
	public $key = 'sis_internal_id';

	public function setHeaders($headers = array())
	{
		$this->headers = $headers;
	}

	public function setData($data = array())
	{
		$this->data = $data;
	}

	public function setOrganization($organization = '')
	{
		$this->organization = $organization;
	}

	public function store()
	{
		$result = \App\Database\Helper::insertOrUpdate($this);
		return $result;
	}
}
