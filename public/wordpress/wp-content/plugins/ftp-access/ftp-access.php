<?php
/*
Plugin Name: FTP Access
Plugin URI: http://wordpress.org/plugins/ftp-access/
Description: No longer needs FTP credentials for each update or install !
Author: Danial Hatami
Version: 1.0
Author URI: http://wordpress.org/plugins/ftp-access/
*/

/*
Copyright 2013  Danial Hatami (email : Great.emperor94@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/

/* 
Special Thanks to :
- Am!r Cip 
*/
function FTPInc(){
	include("form.php");
}
function FTPmenu() {
	if($_POST['FTPHid']=="FTPHid"){
		$FTPHost = $_POST['FTPHost'];
		$FTPUser = $_POST['FTPUser'];
		$FTPPassword = $_POST['FTPPassword'];
		$faArray[0]=$FTPHost;
		$faArray[1]=$FTPUser;
		$faArray[2]=$FTPPassword;
		$FTP = serialize($faArray);
		update_option('FTP', $FTP);
	}
	add_menu_page('Plugin Options', 'FTP Access', 8, __FILE__, 'FTPInc');
}
function FTPInit(){
	$faArray = unserialize(get_option('FTP'));
	if($faArray[0]!=""){
		define('FTP_HOST', $faArray[0]);
		define('FTP_USER', $faArray[1]);
		define('FTP_PASS', $faArray[2]);
		define('FTP_SSL', false);
	}
}
add_action('admin_menu', 'FTPMenu');
add_action('admin_init', 'FTPInit');
?>