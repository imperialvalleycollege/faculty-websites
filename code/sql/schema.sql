CREATE TABLE IF NOT EXISTS `api` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `organization` varchar(255) NOT NULL DEFAULT '',
  `api_key` varchar(255) NOT NULL DEFAULT '',
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  UNIQUE KEY (`id`),
  UNIQUE KEY `organizationApiKey` (`organization`, `api_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  UNIQUE KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `content` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `fulltext` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `url` varchar(1024) NOT NULL,
  `attribs` varchar(5120) NOT NULL,
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  UNIQUE KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `level` int(10) unsigned NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  UNIQUE KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sync_terms` (
  `term_key` varchar(50) NOT NULL,
  `term_name` varchar(75) NOT NULL,
  `row_status` varchar(24) NOT NULL,
  `start_date` varchar(24) NOT NULL,
  `end_date` varchar(24) NOT NULL,
  `duration` varchar(30) NOT NULL,
  `available_ind` varchar(3) NOT NULL,
  UNIQUE KEY `term_key` (`term_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sync_persons` (
  `sis_internal_id` int(11) NOT NULL,
  `sis_id` varchar(100) NOT NULL,
  `sis_username` varchar(75) NOT NULL,
  `sis_password` varchar(75) NOT NULL,
  `sis_email` varchar(100) NOT NULL,
  `sis_first_name` varchar(150) NOT NULL,
  `sis_last_name` varchar(150) NOT NULL,
  `is_employee` tinyint(3) NOT NULL,
  `row_status` varchar(24) NOT NULL,
  `system_role` varchar(54) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  UNIQUE KEY `sis_internal_id` (`sis_internal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sync_courses` (
  `course_key` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `start_date` varchar(24) NOT NULL,
  `end_date` varchar(24) NOT NULL,
  `duration` varchar(30) NOT NULL,
  `master_course_key` varchar(50) NOT NULL,
  `row_status` varchar(24) NOT NULL,
  `allow_guest_ind` varchar(3) NOT NULL,
  `available_ind` varchar(3) NOT NULL,
  `catalog_ind` varchar(3) NOT NULL,
  `desc_page` varchar(3) NOT NULL,
  `description` varchar(4000) NOT NULL,
  `term_key` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `course_number` varchar(50) NOT NULL,
  `division` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `term_code` int(10) NOT NULL,
  `crn` int(10) NOT NULL,
  `enrollment` int(10) NOT NULL,
  `available` int(10) NOT NULL,
  UNIQUE KEY `term_key` (`term_code`,`crn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sync_courses_xlst` (
  `course_key` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `start_date` varchar(24) NOT NULL,
  `end_date` varchar(24) NOT NULL,
  `duration` varchar(30) NOT NULL,
  `row_status` varchar(24) NOT NULL,
  `allow_guest_ind` varchar(3) NOT NULL,
  `available_ind` varchar(3) NOT NULL,
  `catalog_ind` varchar(3) NOT NULL,
  `desc_page` varchar(3) NOT NULL,
  `description` varchar(4000) NOT NULL,
  `term_key` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `course_number` varchar(50) NOT NULL,
  `division` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `term_code` int(10) NOT NULL,
  `primary_crn` int(10) NOT NULL,
  `crosslisted_crns` varchar(300) NOT NULL,
  `enrollment` int(10) NOT NULL,
  `available` int(10) NOT NULL,
  `manually_created` tinyint(3) NOT NULL,
  UNIQUE KEY `course_key` (`course_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sync_coursememberships` (
  `course_key` varchar(36) NOT NULL,
  `term_key` varchar(50) NOT NULL,
  `crn` int(10) NOT NULL,
  `spriden_id` varchar(27) NOT NULL,
  `pidm` int(11) NOT NULL,
  `role` varchar(54) NOT NULL,
  `row_status` varchar(24) NOT NULL,
  `available_ind` varchar(3) NOT NULL,
  `enrollment_date` varchar(24) NOT NULL,
  `username` varchar(75) NOT NULL,
  `student_first_name` varchar(150) NOT NULL,
  `student_last_name` varchar(150) NOT NULL,
  UNIQUE KEY `pidm` (`pidm`,`crn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sync_meetingtimes` (
  `course_id` varchar(50) NOT NULL,
  `term_code` int(10) NOT NULL,
  `crn` int(10) NOT NULL,
  `primary_schedule_code_ind` tinyint(4) NOT NULL,
  `schedule_code` varchar(10) NOT NULL,
  `schedule_code_long` varchar(200) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `monday` varchar(4) NOT NULL,
  `tuesday` varchar(4) NOT NULL,
  `wednesday` varchar(4) NOT NULL,
  `thursday` varchar(4) NOT NULL,
  `friday` varchar(4) NOT NULL,
  `saturday` varchar(4) NOT NULL,
  `override_ind` varchar(20) NOT NULL,
  `begin_time` time NOT NULL,
  `end_time` time NOT NULL,
  `building` varchar(200) NOT NULL,
  `room` varchar(200) NOT NULL,
  `units` decimal(10,2) NOT NULL,
  `break_ind` varchar(10) NOT NULL,
  `weekly_hours` decimal(10,2) NOT NULL,
  `daily_hours` decimal(10,2) NOT NULL,
  `total_hours` decimal(10,2) NOT NULL,
  `last_sync_date` datetime NOT NULL,
  `row_status` varchar(24) NOT NULL,
  UNIQUE KEY `meetingtime_key` (`term_code`,`crn`,`schedule_code`,`monday`,`tuesday`,`wednesday`,`thursday`,`friday`,`saturday`,`override_ind`,`start_date`,`end_date`,`begin_time`,`end_time`,`building`,`room`),
  ADD KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `seating_chart` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` varchar(50) NOT NULL,
  `rows` int(10) unsigned NOT NULL DEFAULT '0',
  `seats_per_row` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `metadata` mediumtext NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `attendance` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sis_id` int(10) unsigned NOT NULL DEFAULT '0',
  `course_id` varchar(50) NOT NULL,
  `meeting_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `attendance_status` varchar(255) NOT NULL DEFAULT '',
  `attendance_note` varchar(2048) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
