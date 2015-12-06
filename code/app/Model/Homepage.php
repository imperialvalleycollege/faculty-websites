<?php
namespace App\Model;

class Homepage extends Base
{
	public function getUsers()
	{
		$query = $this->db->getQuery(true);

		$queryString = "SELECT p.*, UPPER(SUBSTRING(p.sis_last_name, 1, 1)) starts_with
						FROM `sync_persons` p
						WHERE sis_internal_id IN (
							select sis_internal_id
							FROM sync_coursememberships
							WHERE sis_role = 'Instructor'
						    AND organization = 'imperial'
						)
						AND organization = 'imperial'
						ORDER BY sis_last_name";

		$query->setQuery($queryString);
		//$query->select('distinct sis_internal_id');
		//$query->from('sync_coursememberships');
		//$query->where('sis_role =' . $this->db->quote('Instructor'));

		$this->db->setQuery($query);

		$users = $this->db->loadObjectList();

		return $users;
	}
}
