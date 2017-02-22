<?php

header('Content-Type: text/plain;charset=utf-8');

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('memory_limit', '4096M');
date_default_timezone_set('Europe/Paris');

function replace_quote($message)
{
    return str_replace('%QUOTE%', '"', $message);
}

$ini_array = parse_ini_file('./'.$_GET['lang'].'/admin.ini', false);
$ini_array = array_map('replace_quote', $ini_array);
print_r($ini_array);

?>
