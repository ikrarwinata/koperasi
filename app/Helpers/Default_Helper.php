<?php

if (!function_exists('progressValue')) {
	/**
	 * Get percentage of value compare to maximum value.
	 *
	 * @access	public
	 * @param	string|int		$val 	current value
	 * @param	string|int		$max 	maximum value
	 * @return	int 	return percentage of value, max is 100.
	 */
	function progressValue(string|int $val, string|int $max) : int
	{
		if ($max <= 0 || $max == NULL) return $val;
		return ($val / $max) * 100;
	}
}

if (!function_exists('generateId')) {
	/**
	 * Generate new ID based on current timestamps.
	 *
	 * @access	public
	 * @param	string	$prefix 	the prefix of id
	 * @return	string 	return ($prefix . strtotime('now')).
	 */
	function generateId(string $prefix) : string
	{
		return $prefix . strtotime('now');
	}
}

if (!function_exists('safeUnlink')) {
	/**
	 * Same as unlink(), but this will check the existance of the file.
	 * If given $path is a directory, then all the files inside it will be removed.
	 *
	 * @access	public
	 * @param	string	$path 	the file path
	 * @return	bool 	return TRUE if success, false otherwise.
	 */
	function safeUnlink(string $path) : bool
	{
		$result = FALSE;
		if ($path != NULL) {
			if (file_exists($path)) {
				if (is_dir($path)) {
					$it = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
					$files = new RecursiveIteratorIterator(
						$it,
						RecursiveIteratorIterator::CHILD_FIRST
					);
					foreach ($files as $file) {
						if ($file->isDir()) {
							rmdir($file->getRealPath());
						} else {
							unlink($file->getRealPath());
						}
					}
					rmdir($path);
					$result = TRUE;
				} else {
					unlink($path);
					$result = TRUE;
				}
			}
		}
		return $result;
	}
}

if (!function_exists('inputSelect')) {
	/**
	 * Used to select one of the select in html input option.
	 *
	 * @access	public
	 * @param	string|null	$selectvalue 	the select option value
	 * @param	string|null	$value	the value send by server
	 * @param	string|null	$returnstring 	[optional] the return value for selected option. Default is 'selected="true"'
	 * @return	string|null 	return string selected="true" for equal value ($value==$selectvalue).
	 */
	function inputSelect(string|null $selectvalue, string|null $value, string|null $returnstring = 'selected="true"') : string|null
	{
		if ($value == $selectvalue) {
			return $returnstring;
		};
		return NULL;
	}
}

if (!function_exists('columnLetter')) {
	/**
	 * Convert int to char,
	 * Used for working with excel column.
	 * eg : 1 = A, 2 = B
	 *
	 * @access	public
	 * @param	int		$index 	input value (0 = NULL)
	 * @param	bool	$resultToUpperCase [optional] convert to upercase
	 * @return	string|null 	return single char. ( A ~ Z )
	 */
	function columnLetter(int $index, bool $resultToUpperCase = TRUE) : string|null
	{
		$c = intval($index);
		if ($c <= 0) return NULL;

		$letter = '';

		while ($c != 0) {
			$p = ($c - 1) % 26;
			$c = intval(($c - $p) / 26);
			$letter = chr(65 + $p) . $letter;
		}
		if ($resultToUpperCase) $letter = strtoupper($letter);

		return $letter;
	}
}


if (!function_exists('timeLog')) {
	/**
	 * Get time log, used for LastSeen in chat app.
	 * Usage : timeLog($inputDate, $format = "%d days, %m months, %y years, %H Hour %i minutes %s seconds")
	 * 
	 * @access	public
	 * @param	string	inputDate 	input date
	 * @param	string	format 	[optional] string output format
	 * @see		DateTime()->format() for formating option.
	 * @see		formatDate() for shortcut to format a date.
	 * @throws exceptionclass Exception
	 * @return string|null return as defined format or NULL on error
	 */
	function timeLog(string $inputDate, string $format = "%d days, %m months, %Y years, %H Hour %i minutes %s seconds") : string|null
	{
		if (trim($inputDate) == NULL) return NULL;
		$date = formatDate($inputDate, TRUE, 'Y-m-d H:i:s');
		if ($date == NULL) return NULL;

		$datetime1 = new DateTime($date); // input Date
		$datetime2 = new DateTime(date("Y-m-d H:i:s")); // Now
		$interval = $datetime1->diff($datetime2);
		return $interval->format($format);
	}
}

if (!function_exists('formatDate')) {
	/**
	 * Format date from any format into desired format,
	 * useful for quick formating layout.
	 * accept timestamps.
	 * accept d-m-Y or d/m/Y or d\m\Y.
	 * accept time at the end of the string : d-m-Y H:i:s
	 *
	 * @access public
	 * @param string $date input date from any format
	 * @param bool $useTime	[optional] using time if available in the input value. Default is TRUE
	 * @param string|null $returnFormat [optional] The output format. Default is 'd-m-Y H:i:s'. Accept 'timestamps' or 'timestamp' for Unix timestamp
	 * @return string|null return dd-mm-YY [H:i:s] or NULL on error
	 * @see getYear(), for short code get year from a date;
	 * @see getMonth() for short code get month from a date;
	 * @see getDay() for short code get day from a date;
	 */
	function formatDate(string $date, bool $useTime = TRUE, string|null $returnFormat = NULL, string|null $appendTime = NULL) : string|null
	{
		if (trim($date) == NULL) return NULL;
		$date = trim($date);
		$c = array();
		$time = NULL;
		$res = NULL;
		if ($returnFormat == NULL) $returnFormat = 'd-m-Y H:i:s';
		try {
			if (strpos($date, " ") !== FALSE) {
				$t = explode(" ", $date);
				if (isset($t[1]) && $t[1] != NULL) {
					$time = " " . $t[1];
				} else {
					if ($appendTime != NULL) $time = " " . $appendTime;
				}
				$date = $t[0];
				if (trim($date) == NULL) {
					return NULL;
				};
			}
			if (strpos($date, "-") !== FALSE) {
				$c = explode("-", $date);
			} else if (strpos($date, "/") !== FALSE) {
				$c = explode("/", $date);
			} else if (strpos($date, "\\") !== FALSE) {
				$c = explode("\\", $date);
			} else if ($date != NULL) {
				if ($date >= 1) $res = date("d-m-Y", $date);
			} else {
				return NULL;
			};
			if (count($c) >= 1) {
				if (strlen($c[0]) >= 4) {
					$res = trim($c[2]) . "-" . trim($c[1]) . "-" . trim($c[0]);
				} else if ($c[1] >= 13) {
					$res = trim($c[1]) . "-" . trim($c[0]) . "-" . trim($c[2]);
				} else if (isset($c[2]) && $c[1] != NULL) {
					$res = str_replace("/", "-", $date);
					$res = str_replace("\\", "-", $date);
				} else {
					$res = $date;
				}
			}
			if ($useTime) $res .= $time;
			if (strtolower($returnFormat) == 'timestamps' || strtolower($returnFormat) == 'timestamp'){
				$res = strtotime($res);
			}else{
				$res = date($returnFormat, strtotime($res));
			}
		} catch (Exception $e) {
			$res = NULL;
		}
		return $res;
	}
}

if (!function_exists('getTime')) {
	/**
	 * Get the time from string date
	 *
	 * @access	public
	 * @param	string	$date 	input date value (only accept format d-m-Y H:i:s)
	 * @return	string|null	return as given time or NULL on error
	 */
	function getTime(string $date) : string|null
	{
		if ($date == NULL) return NULL;
		$res = NULL;
		try {
			if (strpos($date, ' ') !== FALSE) {
				$res = explode(' ', $date)[1];
			} else {
				$res = NULL;
			}
		} catch (Exception $e) {
			$res = NULL;
		}
		return $res;
	}
}

if (!function_exists('getDay')) {
	/**
	 * Get the day from string date
	 *
	 * @access	public
	 * @param	string	$date 	input date value (only accept format 'd-m-Y' or 'd-m-Y H:i:s')
	 * @return	int|false return as day or FALSE on error
	 * @see dayToString() for string month
	 */
	function getDay(string $date) : int|false
	{
		if ($date == NULL) return FALSE;
		$res = FALSE;
		try {
			$separator = NULL;
			if (strpos($date, '-') !== FALSE) {
				$separator = "-";
			} elseif (strpos($date, '/') !== FALSE) {
				$separator = "/";
			} elseif (strpos($date, '\\') !== FALSE) {
				$separator = "\\";
			} elseif (strpos($date, ' ') !== FALSE) {
				$separator = " ";
			} else {
				return FALSE;
			}
			if (strpos($date, ' ') !== FALSE) $date = explode(' ', $date)[0];
			$temp = explode($separator, $date);
			$index = 0;
			if ($temp[0] <= 31) {
				$index = 0;
			} elseif ($temp[1] <= 31) {
				$index = 1;
			} elseif ($temp[2] <= 31) {
				$index = 2;
			}
			$res = $temp[$index];
		} catch (Exception $e) {
			$res = FALSE;
		}
		return $res;
	}
}

if (!function_exists('getMonth')) {
	/**
	 * Get the month from string date
	 *
	 * @access	public
	 * @param	string	$date 	input date value (only accept format 'd-m-Y' or 'd-m-Y H:i:s')
	 * @return	int|false 	return as month (1 - 12) or FALSE on error
	 * @see monthToString() for string month
	 */
	function getMonth(string $date) : int|false
	{
		if ($date == NULL) return FALSE;
		$res = FALSE;
		try {
			$separator = NULL;
			if (strpos($date, '-') !== FALSE) {
				$separator = "-";
			} elseif (strpos($date, '/') !== FALSE) {
				$separator = "/";
			} elseif (strpos($date, '\\') !== FALSE) {
				$separator = "\\";
			} elseif (strpos($date, ' ') !== FALSE) {
				$separator = " ";
			} else {
				return FALSE;
			}
			if (strpos($date, ' ') !== FALSE) $date = explode(' ', $date)[0];
			$temp = explode($separator, $date);
			$index = 1;
			if ($temp[1] <= 12) {
				$index = 1;
			} elseif ($temp[0] <= 12) {
				$index = 0;
			} elseif ($temp[2] <= 12) {
				$index = 2;
			}
			$res = $temp[$index];
		} catch (Exception $e) {
			$res = FALSE;
		}
		return $res;
	}
}

if (!function_exists('getYear')) {
	/**
	 * Get the year from string date
	 *
	 * @access	public
	 * @param	string	$date 	input date value (only accept format 'd-m-Y' or 'd-m-Y H:i:s')
	 * @return	int|false 	return as year or FALSE on error
	 */
	function getYear(string $date) : int|false
	{
		if ($date == NULL) return FALSE;
		$res = FALSE;
		try {
			$separator = NULL;
			if (strpos($date, '-') !== FALSE) {
				$separator = "-";
			} elseif (strpos($date, '/') !== FALSE) {
				$separator = "/";
			} elseif (strpos($date, '\\') !== FALSE) {
				$separator = "\\";
			} elseif (strpos($date, ' ') !== FALSE) {
				$separator = " ";
			} else {
				return FALSE;
			}
			if (strpos($date, ' ') !== FALSE) $date = explode(' ', $date)[0];
			$temp = explode($separator, $date);
			$index = 2;
			if ($temp[2] >= 32) {
				$index = 2;
			} elseif ($temp[1] >= 32) {
				$index = 1;
			} elseif ($temp[0] >= 32) {
				$index = 0;
			}
			$res = $temp[$index];
		} catch (Exception $e) {
			$res = FALSE;
		}
		return $res;
	}
}

if (!function_exists('monthToString')) {
	/**
	 * Convert month into string
	 *
	 * @access	public
	 * @param	mixed $date input date. Accept month or string date or unix timestamp, default is today.
	 * @param	array $arrayLangMonths [optional] list string date for the result, or use listStringMonth() for default.
	 * @return	string|null	spellout the given date.
	 * @see listStringMonth() for the language array.
	 */
	function monthToString(mixed $date = NULL, array $arrayLangMonths = NULL) : string|null
	{
		if ($date == NULL) {
			$date = date("m", mktime(0, 0, 0, date("m"), date("d"), date("Y")));
		} elseif (is_int($date)) {
			if ($date <= 12) {
				$date = $date * 1;
				return $arrayLangMonths[$date];
			}else{
				$date = $date * 1;
				return $arrayLangMonths[date("m", $date)];
			}
		}else{
			if (strlen($date) >= 3) {
				$date = date("m", strtotime(formatDate($date, TRUE, 'timestamp')));
			}
		}
		if ($arrayLangMonths == NULL) $arrayLangMonths = ['', 'January', "February", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
		if ($date <= count($arrayLangMonths)) {
			$date = $date * 1;
			return $arrayLangMonths[$date];
		} else {
			return NULL;
		}
	}
}

if (!function_exists('listStringMonth')) {
	/**
	 * Get list of month. eg : January, February, etc
	 * Zero index is NULL.
	 * used for function monthToString(12, listStringMonth())
	 *
	 * @access	public
	 * @return	array return [January, February, etc]
	 */
	function listStringMonth() : array
	{
		return ['', 'January', "February", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
	}
}

if (!function_exists('dayToString')) {
	/**
	 * Convert day into string
	 *
	 * @access	public
	 * @param	mixed	$inputDate 	[optional] accept unix timestamp or string date, default is today
	 * @param	array	$arrayLangDays 	[optional] list string day for the result, or use listStringDay() for default
	 * @return	string|null	spellout the given date.
	 * @see listStringDay() for the language array.
	 */
	function dayToString(mixed $inputDate = NULL, array $arrayLangDays = NULL) : string|null
	{
		$temp = NULL;
		if ($inputDate == NULL) {
			$temp = date("w", strtotime("now"));
		}elseif (is_int($inputDate)){
			$temp = date("w", $inputDate);
		} else {
			$temp = date("w", strtotime(formatDate($inputDate, TRUE, 'timestamp')));
		}
		if ($arrayLangDays == NULL) $arrayLangDays = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
		if ($temp <= count($arrayLangDays)) {
			$temp = $temp * 1;
			return $arrayLangDays[$temp];
		} else {
			return NULL;
		}
	}
}

if (!function_exists('listStringDay')) {
	/**
	 * Get list of day. eg : Sunday, Monday, etc
	 * Zero index is NULL.
	 * used for function dayToString($date, listStringDay())
	 *
	 * @access	public
	 * @return	array	return [Sunday, Monday, etc]
	 */
	function listStringDay() : array
	{
		return ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
	}
}

if (!function_exists('setTimezone')) {
	/**
	 * set Timezone
	 *
	 * @access	public
	 * @param	string	$zone Timezone, default is 'Asia/Jakarta'
	 */
	function setTimezone($zone = 'Asia/Jakarta')
	{
		date_default_timezone_set($zone);
	}
}

if (!function_exists('formatNumber')) {
	/**
	 * Format given number into rupiah format. eg : 1.000.000
	 *
	 * @access	public
	 * @param int $number input number
	 * @param int $decimal [optional] Sets the number of decimal points.
	 * @param string $decimal_separator [optional]
	 * @param string $thousands_separator [optional]
	 * @return string|null return as string formated or NULL on error
	 */
	function formatNumber(int $number, int $decimal = 0, string $decimal_separator = ',', string $thousands_separator = ".") : string|null
	{
		if($number == NULL) return NULL;
		$result = 0;
		try {
			$result = number_format($number, $decimal, $decimal_separator, $thousands_separator);
		} catch (Exception $e) {
			$result = $number;
		}
		return $result;
	}
}

if (!function_exists('strSentence')) {
	/**
	 * Convert string into upper case for each word.
	 *
	 * @access	public
	 * @param	string	$str 	input string
	 * @return	string 	return as string	
	 */
	function strSentence(string $str) : string
	{
		if (trim($str) == NULL) return NULL;
		$res = strtoupper(substr($str, 0, 1)) . substr($str, 1);
		if (strpos($str, "\r\n") !== FALSE) {
			$c = explode("\r\n", $res);
			$res = NULL;
			foreach ($c as $key => $line) {
				$res .= strSentence($line) . "\r\n";
			}
		}
		if (strpos($str, " ") !== FALSE) {
			$c = explode(" ", $res);
			$res = NULL;
			foreach ($c as $key => $line) {
				$res .= strSentence($line) . " ";
			};
			$res = substr($res, 0, strlen($res) - 1);
		}
		return $res;
	}
}

if (!function_exists('strCut')) {
	/**
	 * Cut string if its longer than given length, add extention at the end of string.
	 *
	 * @access	public
	 * @param	string	$str input string
	 * @param	int	$length maximum length
	 * @param	string	$extention at the end of string
	 * @return	string|null return as string or NULL
	 */
	function strCut(string $str, int $length = 25, string $extention = "...") : string|null
	{
		if (trim($str) == NULL) return NULL;

		if ($length <= strlen($str)) return (substr($str, 0, $length) . ($extention != NULL ? $extention : NULL));

		return $str;
	}
}

if (!function_exists('dateAdd')) {
	/**
	 * Increase date value by specified day
	 *
	 * @access	public
	 * @param	string	$date input date. any format.
	 * @param	int 	$increament 	[optional] increament value.
	 * @param	string 	$returnFormat [optional] The output format. Default is 'd-m-Y H:i:s'. Accept 'timestamps' or 'timestamp' for Unix timestamp
	 * @return	string|null return increased date as string	or NULL on error
	 */
	function dateAdd(string $date, int $increament = 1, string $returnFormat = "d-m-Y H:i:s") : string|null
	{
		$result = NULL;
		$temp = NULL;
		try {
			if (is_int($date)) {
				$temp = strtotime("+" . $increament . " day", $date);
			}else{
				$temp = strtotime("+" . $increament . " day", formatDate($date, TRUE, 'timestamps'));
			}
			if (strtolower($returnFormat) == "timestamp" || strtolower($returnFormat) == "timestamps") {
				$result = $temp;
			} else {
				$result = date($returnFormat, $temp);
			}
		} catch (Exception $e) {
			$temp = $date;
		}		
		return $result;
	}
}

if (!function_exists('dateSub')) {
	/**
	 * Decrease date value by specified day
	 *
	 * @access	public
	 * @param	string	$date input date. any format.
	 * @param	int 	$decreament 	[optional] decreament value.
	 * @param	string 	$returnFormat [optional] The output format. Default is 'd-m-Y H:i:s'. Accept 'timestamps' or 'timestamp' for Unix timestamp
	 * @return	string|null return decreased date as string	or NULL on error
	 */
	function dateSub(string $date, int $decreament = 1, string $returnFormat = "d-m-Y H:i:s"): string|null
	{
		$result = NULL;
		$temp = NULL;
		try {
			if (is_int($date)) {
				$temp = strtotime("-" . $decreament . " day", $date);
			} else {
				$temp = strtotime("-" . $decreament . " day", formatDate($date, TRUE, 'timestamps'));
			}
			if (strtolower($returnFormat) == "timestamp" || strtolower($returnFormat) == "timestamps") {
				$result = $temp;
			} else {
				$result = date($returnFormat, $temp);
			}
		} catch (Exception $e) {
			$temp = $date;
		}
		return $result;
	}
}

if (!function_exists('isOdd')) {
	/**
	 * Is given number is Odd ?
	 *
	 * @access	public
	 * @param	int 	$number 	input number
	 * @return	bool	return TRUE if given number is Odd, FALSE otherwise.
	 */
	function isOdd(int $number) : bool
	{
		if ($number % 2 == 0) {
			return false;
		} else {
			return true;
		}
	}
}

if (!function_exists('isEven')) {
	/**
	 * Is given number is Even ?
	 *
	 * @access	public
	 * @param	int 	$number 	input number
	 * @return	bool	return TRUE if given number is Even, FALSE otherwise.
	 */
	function isEven(int $number) : bool
	{
		if ($number % 2 == 0) {
			return true;
		} else {
			return false;
		}
	}
}
