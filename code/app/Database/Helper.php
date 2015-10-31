<?php
namespace App\Database;

class Helper
{
	public static function quoteNames($columns)
	{
		$db = \App\Factory::getDbo();

		$quotedNames = array();
		foreach($columns as $column)
		{
			$quotedNames[] = $db->quoteName($column);
		}

		return $quotedNames;
	}

	public static function quoteValues($data)
	{
		$db = \App\Factory::getDbo();

		$quotedData = array();
		foreach($data as $value)
		{
			$quotedData[] = $db->quote($value);
		}

		return $quotedData;
	}

	public static function getSetString($columns, $data)
	{
		$db = \App\Factory::getDbo();
		$output = array();

		foreach($columns as $index => $column)
		{
			$output[] = $db->quoteName($column) . ' = ' . $db->quote($data[$index]);
		}

		return implode(', ', $output);
	}

	public static function getCurrentDateTime()
	{
		$date_utc = new \DateTime(null, new \DateTimeZone("UTC"));
		$currentDateTime = $date_utc->format('Y-m-d H:i:s');

		return $currentDateTime;
	}

	public static function insertOrUpdate($table, $headers, $data)
	{
		$db = \App\Factory::getDbo();

		$db->getQuery(true);

		$fields = implode(',', \App\Database\Helper::quoteNames($headers));
		$values = implode(',', \App\Database\Helper::quoteValues($data));
		$setString = \App\Database\Helper::getSetString($headers, $data);
		$currentDateTime = $db->quote(\App\Database\Helper::getCurrentDateTime());

		$sql = <<<SQL
		INSERT INTO $table (
			$fields,
			created,
			updated
		)
		VALUES (
			$values,
			$currentDateTime,
			$currentDateTime
		)
		ON DUPLICATE KEY UPDATE
			$setString,
			updated = $currentDateTime
SQL;

		$db->setQuery($sql);

		$result = $db->execute();

		return $result;
	}
}
