<?php
require_once('File.php');
require_once('Log.php');
require_once('Lead.php');

$inputFile = 'leads.json';
$outputFile = 'unique_leads.json';

$file = new File($inputFile, $outputFile);
$log = new Log();
$lead = new Lead($file, $log);
$lead->execute();