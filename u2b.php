<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

session_start();

# Get the full list of mobile numbers
$fo = file_get_contents($_POST['input_file_location']);
$fo = preg_replace('~\R~u', PHP_EOL, $fo); // replace different type of line breaks
$lines = array_filter(explode(PHP_EOL, $fo)); // convert string to array, ommit empty strings

$input_filepath = $_POST['input_file_location'];

$output_filepath = rtrim($_POST['input_file_location'], '.csv') . '-output.csv';
$output_file = fopen($output_filepath, 'w');
fprintf($output_file, chr(0xEF).chr(0xBB).chr(0xBF)); // write utf-8 BOM

$is_title_row = true;

foreach ($lines as $line) {
	$e = explode(',', $line);
	
	if (!$is_title_row) {
		$e[$_POST['unicode_column']] = iconv('UCS-2BE', 'UTF-8', hex2bin($e[$_POST['unicode_column']]));
	} else {
		$is_title_row = false;
	}

	fputcsv($output_file, $e);
}

fclose($output_file);

$_SESSION['success_msg'] = "Converted Successfully.";
$_SESSION['info_msg'] = 'Output file - ' . $output_filepath;
header('Location: index.php');
