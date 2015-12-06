<?php
namespace App\Model;

class Instructor extends Base
{
	protected $valid = false;
	protected $instructor;
	protected $courses;
	protected $uniqueCourses;

	public function __construct($username)
	{
		parent::__construct();

		$query = $this->db->getQuery(true);

		$quotedUsername = $this->db->quote($username);
		$queryString = "SELECT p.*
						FROM `sync_persons` p
						WHERE organization = 'imperial'
						AND sis_username = {$quotedUsername}";

		$query->setQuery($queryString);
		$this->db->setQuery($query);

		$data = $this->db->loadObject();

		if (!empty($data))
		{
			$this->instructor = $data;
			$this->valid = true;
		}
	}

	public function isValid()
	{
		return $this->valid;
	}

	public function getData()
	{
		return $this->instructor;
	}

	public function getCourses()
	{
		if ($this->isValid())
		{
			if (empty($this->courses))
			{
				$query = $this->db->getQuery(true);

				$quotedInternalId = $this->db->quote($this->instructor->sis_internal_id);
				$queryString = "SELECT c.*, CONCAT(c.sis_subject, ' ', c.sis_course_number) course_short_name, t.sis_term_name, t.sis_term_start_date, sis_term_end_date
								FROM `sync_coursememberships` cm
								INNER JOIN
									`sync_courses` c
								ON
									cm.sis_course_id = c.sis_course_id
								INNER JOIN
									`sync_terms` t
								ON
									c.sis_term_key = t.sis_term_key
								WHERE cm.sis_internal_id = {$quotedInternalId}
								AND cm.organization = 'imperial'
								ORDER BY c.sis_subject, c.sis_course_number";

				$query->setQuery($queryString);
				$this->db->setQuery($query);

				$this->courses = $this->db->loadObjectList();
			}

			return $this->courses;
		}
	}

	public function getUniqueCourses()
	{
		if (empty($this->uniqueCourses))
		{
			// Makes sure we have course data:
			$this->getCourses();

			$this->uniqueCourses = \App\Model\Base::group($this->courses, 'course_short_name');
		}

		return $this->uniqueCourses;
	}
}
