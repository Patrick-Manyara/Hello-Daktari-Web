<?php
function get_day_name($string)
{
	$timestamp = strtotime($string);
	$dayname = date("D", $timestamp);
	return $dayname;
}

function get_day($string)
{
	$timestamp = strtotime($string);
	$day = date("d", $timestamp);
	return $day;
}

function get_ordinal_day($string)
{
	$timestamp = strtotime($string);
	$day = date("jS", $timestamp);
	return $day;
}

function get_month_name($string)
{
	$timestamp = strtotime($string);
	$month_name = date("M", $timestamp);
	return $month_name;
}

function get_month($string)
{
	$timestamp = strtotime($string);
	$month = date("m", $timestamp);
	return $month;
}

function get_full_year($string)
{
	$timestamp = strtotime($string);
	$year =  date("Y", $timestamp);
	return $year;
}

function get_short_year($string)
{
	$timestamp = strtotime($string);
	$short_year =  date("y", $timestamp);
	return $short_year;
}

function get_current_year()
{
	$current_year = date("Y");
	return $current_year;
}

function get_hours_mins($string)
{
    $timestamp = strtotime($string);
	$time =  date("H:ia", $timestamp);
	return $time;
}

function get_ordinal_month_year($string)
{
	$timestamp = strtotime($string);
	$day = date("jS", $timestamp);
	$dayname = date("D", $timestamp);
	$month_name = date("M", $timestamp);
	$year =  date("Y", $timestamp);
	return $dayname .", ". $day . " " . $month_name . " " . $year;
}

