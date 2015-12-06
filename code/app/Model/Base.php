<?php
namespace App\Model;

class Base
{
	protected $db;

	public function __construct()
	{
		$this->db = \App\Factory::getDbo();
	}

	public static function group($data, $field)
	{
		$grouped = array();

		if (!empty($data))
		{
			foreach($data as $datum)
			{
				if (!isset($grouped[$datum->$field]))
				{
					$grouped[$datum->$field] = array();
				}

				$grouped[$datum->$field][] = $datum;
			}
		}

		return $grouped;
	}
}
