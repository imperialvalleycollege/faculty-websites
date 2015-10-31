<?php
namespace App\Import;

use App\Import;

class Helper
{
	const COURSEMEMBERSHIP_EXPECTED_HEADER = 'EXTERNAL_COURSE_KEY|EXTERNAL_PERSON_KEY|ROLE|ROW_STATUS|AVAILABLE_IND';
	const COURSE_EXPECTED_HEADER = 'EXTERNAL_COURSE_KEY|COURSE_ID|COURSE_NAME|START_DATE|END_DATE|DURATION|MASTER_COURSE_KEY|ROW_STATUS|ALLOW_GUEST_IND|AVAILABLE_IND|CATALOG_IND|DESC_PAGE|DESCRIPTION|TERM_KEY';
	const MEETINGTIME_EXPECTED_HEADER = 'COURSE_ID|TERM_CODE|CRN|PRIMARY_SCHEDULE_CODE_IND|SCHEDULE_CODE|SCHEDULE_CODE_LONG|START_DATE|END_DATE|MONDAY|TUESDAY|WEDNESDAY|THURSDAY|FRIDAY|SATURDAY|OVERRIDE_IND|BEGIN_TIME|END_TIME|BUILDING|ROOM|UNITS|BREAK_IND|WEEKLY_HOURS|DAILY_HOURS|TOTAL_HOURS|LAST_SYNC_DATE|ROW_STATUS';
	const PERSON_EXPECTED_HEADER = 'sis_internal_id|sis_id|sis_username|sis_password|sis_email|sis_first_name|sis_last_name|is_employee|row_status|system_role';
	const TERM_EXPECTED_HEADER = 'EXTERNAL_TERM_KEY|NAME|ROW_STATUS|START_DATE|END_DATE|DURATION|AVAILABLE_IND';

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

