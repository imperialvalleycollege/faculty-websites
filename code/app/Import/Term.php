<?php
namespace App\Import;

class Term implements ImportInterface
{
	public $table = 'sync_terms';
	public $organization = '';
	public $headers = array();
	public $data = array();
	public $key = 'sis_term_key';

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
