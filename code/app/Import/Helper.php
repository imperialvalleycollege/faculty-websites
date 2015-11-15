<?php
namespace App\Import;

use App\Import;

class Helper
{
	const COURSEMEMBERSHIP_EXPECTED_HEADER = 'sis_course_id|sis_term_key|sis_crn|sis_internal_id|sis_role|row_status';
	const COURSE_EXPECTED_HEADER = 'sis_course_id|sis_term_key|sis_crn|sis_course_name|sis_subject|sis_subject_long|sis_course_number|sis_division|sis_division_long|sis_department|sis_department_long|sis_start_date|sis_end_date|sis_master_course_id|sis_units|sis_max_enrollment|sis_enrollment|sis_available|sis_waitlisted|sis_description|row_status';
	const MEETINGTIME_EXPECTED_HEADER = 'COURSE_ID|TERM_CODE|CRN|PRIMARY_SCHEDULE_CODE_IND|SCHEDULE_CODE|SCHEDULE_CODE_LONG|START_DATE|END_DATE|MONDAY|TUESDAY|WEDNESDAY|THURSDAY|FRIDAY|SATURDAY|OVERRIDE_IND|BEGIN_TIME|END_TIME|BUILDING|ROOM|UNITS|BREAK_IND|WEEKLY_HOURS|DAILY_HOURS|TOTAL_HOURS|LAST_SYNC_DATE|ROW_STATUS';
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

