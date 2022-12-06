<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

session_start();
$input_file_location = $_POST['input_file_location'];
# Get the full list of mobile numbers
$infile_handle = fopen($input_file_location, 'r');

$output_filepath = rtrim($input_file_location, '.csv') . '-output.csv';
$outfile_handle = fopen($output_filepath, 'w');
fprintf($outfile_handle, chr(0xEF) . chr(0xBB) . chr(0xBF)); // write utf-8 BOM

$is_title_row = true;
$unicode_column_index = $_POST['unicode_column'];
while (($raw_string = fgets($infile_handle)) !== false) {
	$row = str_getcsv($raw_string);

	if (!$is_title_row) {
		$row[$unicode_column_index] = iconv('UCS-2BE', 'UTF-8', hex2bin($row[$unicode_column_index]));
	} else {
		$is_title_row = false;
	}

	fputcsv($outfile_handle, $row);
}

fclose($infile_handle);
fclose($outfile_handle);

$_SESSION['success_msg'] = "Converted Successfully.";
$_SESSION['info_msg'] = 'Output file - ' . $output_filepath;
header('Location: index.php');
exit;
