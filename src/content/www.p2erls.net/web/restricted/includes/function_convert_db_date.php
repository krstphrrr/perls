<?php
class date_functions {
	/*
	function calc_to_db_time($hour, $minute, $meridian) {
		if ($meridian == 'am') {
			if (strlen($hour) == 1) {
				$new_hour = '0'.$hour;
			}
			else {
				if ($hour == '12') {
					$new_hour = '24';
				} else {
					$new_hour = $hour;
				}
			}
		}
		if ($meridian == 'pm') {
			if ($hour == '12') {
				$new_hour = '12';
			} else {
				$new_hour = $hour + 12;
			}
		}
		$time = $new_hour.':'.$minute;
		return $time;
	}
	
	function convert_from_db_time($time) {
		$x = explode(":", $time);
		$hour = $x[0]; $minute = $x[1]; $seconds = $x[2];
		
		if ($hour >= '12') {
			$meridian = 'pm';
		}
		else {
			$meridian = 'am';
		}
		if ($meridian == 'am') {
			if ($hour{0} == '0') {
				if ($hour == '00') {
					$new_hour = 12;
				}
				else {
					$new_hour = ltrim($hour, "0");
				}
			}
			else {
				$new_hour = $hour;
			}
		}
		if ($meridian == 'pm') {
			$new_hour = $hour - 12;
		}
		$new_time = $new_hour.':'.$minute.':'.$meridian;
		return $new_time;
	}
	
	function convert_to_db_date ($date, $char) {
		if ($char == 'slashes') {
			$x = explode("/", $date);
		}
		if ($char == 'dashes') {
			$x = explode("-", $date);
		}
		$month = $x[0]; $day = $x[1]; $year = $x[2];
		$db_date = "$year-$month-$day";
		return $db_date;
	}
	
	function convert_from_db_date ($date) {
		$x = explode("-", $date);
		$year = $x[0]; $month = $x[1]; $day = $x[2];
		$display_date = "$month/$day/$year";
		return $display_date;
	}
	*/
	function convert_db_date ($proposed_date)
	{
		$x = explode(" ", $proposed_date);
		$db_date = $x[0]; $db_time = $x[1];
		
		$y = explode("-", $db_date);
		$year = $y[0]; $month = $y[1]; $day = $y[2];
		$display_date = "$month/$day/$year";
		
		$z = explode(":", $db_time);
		$hour = $z[0]; $minute = $z[1]; $seconds = $z[2];		
		if ($hour >= '12') { $meridian = 'PM'; } else { $meridian = 'AM'; }
		if ($meridian == 'AM')
		{
			if ($hour{0} == '0')
			{
				if ($hour == '00') { $new_hour = 12; } else { $new_hour = ltrim($hour, "0"); }
			}
			else
			{
				$new_hour = $hour;
			}
		}
		if ($meridian == 'PM')
		{
			if ($hour != 12) { $new_hour = $hour - 12; } else { $new_hour = $hour; }
		}
		$display_time = $new_hour.':'.$minute.':'.$seconds.' '.$meridian.' MST';
		$converted_date = "$display_date<br />$display_time";
		return $converted_date;
	}
}
?>