<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

# Get the full list of mobile numbers
$fo = file_get_contents('data.csv');
$fo = preg_replace('~\R~u', PHP_EOL, $fo); // replace different type of line breaks
$lines = array_filter(explode(PHP_EOL, $fo)); // convert string to array, ommit empty strings

$output_file = fopen('output.csv', 'w');

foreach ($lines as $line) {
	$e = explode(',', $line);
	// var_dump($e);
	$e[2] = iconv('UCS-2BE','UTF-8', hex2bin($e[2]));
	fputcsv($output_file, $e);
}

fclose($output_file);
