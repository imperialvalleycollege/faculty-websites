<?php
namespace App\Import;

use App\Import;

class Helper
{
	const COURSEMEMBERSHIP_EXPECTED_HEADER = 'sis_course_id|sis_term_key|sis_crn|sis_internal_id|sis_role|row_status';
	const COURSE_EXPECTED_HEADER = 'sis_course_id|sis_term_key|sis_crn|sis_course_name|sis_subject|sis_subject_long|sis_course_number|sis_division|sis_division_long|sis_department|sis_department_long|sis_start_date|sis_end_date|sis_master_course_id|sis_units|sis_max_enrollment|sis_enrollment|sis_available|sis_waitlisted|sis_description|row_status';
	const MEETINGTIME_EXPECTED_HEADER = 'sis_course_id|sis_term_key|sis_crn|sis_schedule_code|sis_schedule_code_long|sis_primary_schedule_code_ind|sis_start_date|sis_end_date|sis_begin_time|sis_end_time|sis_monday_ind|sis_tuesday_ind|sis_wednesday_ind|sis_thursday_ind|sis_friday_ind|sis_saturday_ind|sis_override_ind|sis_building|sis_room|sis_units|sis_break_ind|sis_weekly_hours|sis_daily_hours|sis_total_hours|row_status';
	const PERSON_EXPECTED_HEADER = 'sis_internal_id|sis_id|sis_username|sis_password|sis_email|sis_first_name|sis_last_name|is_employee|row_status|system_role';
	const TERM_EXPECTED_HEADER = 'sis_term_key|sis_term_name|sis_term_start_date|sis_term_end_date';

	public static function importType($headers)
	{
		$providedHeaders = implode('|', $headers);
		$providedHeaders = strtolower($providedHeaders);

		switch($providedHeaders)
		{
			case self::COURSEMEMBERSHIP_EXPECTED_HEADER:
				return 'Coursemembership';
			case self::COURSE_EXPECTED_HEADER:
				return 'Course';
			case self::MEETINGTIME_EXPECTED_HEADER:
				echo "Meetingtime";
				return 'Meetingtime';
			case self::PERSON_EXPECTED_HEADER:
				return 'Person';
			case self::TERM_EXPECTED_HEADER:
				return 'Term';
			default:
				return null;
		}
	}

	/**
	* put your comment there...
	*
	* @return ImportInterface
	*/
	public static function createImportObject($type)
	{
		$classname = '\\App\\Import\\' . $type;
		return new $classname();
	}
}

