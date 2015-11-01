<?php
namespace App\Import;

interface ImportInterface
{
	public function setHeaders();
	public function setData();
	public function setOrganization();
	public function store();
}
