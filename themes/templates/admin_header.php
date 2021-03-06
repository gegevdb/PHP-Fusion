<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: admin_header.php
| Author: Nick Jones (Digitanium)
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (!defined("IN_FUSION")) { die("Access Denied"); }

define("ADMIN_PANEL", TRUE);

if ($settings['maintenance'] == "1" && ((iMEMBER && $settings['maintenance_level'] == USER_LEVEL_MEMBER && $userdata['user_id'] != "1") || ($settings['maintenance_level'] < $userdata['user_level']))) {
	redirect(BASEDIR."maintenance.php");
}

/*
if (isset($_GET['checklogin'])) {
	$answer = array();
	$password = isset($_POST['admin_password']) ? stripinput($_POST['admin_password']) : '';
	if (check_admin_pass($password)) {
		$answer['isLogged'] = "1";
	} else {
		$answer['isLogged'] = "0";
	}
	//$answer['notice'] = getNotices();
	$answer = json_encode($answer);
	exit($answer);
}
*/

require_once INCLUDES."breadcrumbs.php";
require_once INCLUDES."header_includes.php";
require_once THEMES."templates/render_functions.php";

if (preg_match("/^([a-z0-9_-]){2,50}$/i", $settings['admin_theme']) && file_exists(THEMES."admin_templates/".$settings['admin_theme']."/acp_theme.php")) {
	require_once THEMES."admin_templates/".$settings['admin_theme']."/acp_theme.php";
} else {
	die('WARNING: Invalid Admin Panel Theme'); // TODO: improve this
}

if (iMEMBER) {
	$result = dbquery("UPDATE ".DB_USERS." SET user_lastvisit='".time()."', user_ip='".USER_IP."', user_ip_type='".USER_IP_TYPE."' WHERE user_id='".$userdata['user_id']."'");
}

$bootstrap_theme_css_src = '';
// Load bootstrap
if ($settings['bootstrap']) {
	define('BOOTSTRAPPED', TRUE);
	$bootstrap_theme_css_src = INCLUDES."bootstrap/bootstrap.css";
	add_to_footer("<script type='text/javascript' src='".INCLUDES."bootstrap/bootstrap.min.js'></script>");
	add_to_footer("<script type='text/javascript' src='".INCLUDES."bootstrap/holder.js'></script>");
}

if ($settings['tinymce_enabled'] == 1) {
	$tinymce_list = array();
	$image_list = makefilelist(IMAGES, ".|..|");
	$image_filter = array('png', 'PNG', 'bmp', 'BMP', 'jpg', 'JPG', 'jpeg', 'gif', 'GIF', 'tiff', 'TIFF');
	foreach ($image_list as $image_name) {
		$image_1 = explode('.', $image_name);
		$last_str = count($image_1) - 1;
		if (in_array($image_1[$last_str], $image_filter)) {
			$tinymce_list[] = array('title' => $image_name, 'value' => IMAGES . $image_name);
		}
	}
	$tinymce_list = json_encode($tinymce_list);
}

require_once THEMES."templates/panels.php";
ob_start();

require_once ADMIN."admin.php";
$admin = new Admin();

// Use infusion_db file to modify admin properties
$infusion_folder = makefilelist(INFUSIONS, ".|..|", "", "folders");
if (!empty($infusion_folder)) {
	foreach($infusion_folder as $folder) {
		if (file_exists(INFUSIONS.$folder."/infusion_db.php")) {
			include INFUSIONS.$folder."/infusion_db.php";
		}
	}
}


// Dashboard breadcrumb

add_breadcrumb(array('link'=>ADMIN.'index.php'.$aidlink.'&amp;pagenum=0', 'title'=>$locale['ac10']));
// Page group breadcrump
// TODO: Fix breadcrumb for infusions
$activetab = (isset($_GET['pagenum']) && isnum($_GET['pagenum'])) ? $_GET['pagenum'] : $admin->_isActive();
if ($activetab != 0) {
	add_breadcrumb(array('link'=>ADMIN.$aidlink."&amp;pagenum=$activetab", 'title'=>$locale['ac0'.$activetab]));
}
// If the user is not logged in as admin then don't parse the administration page
// otherwise it could result in bypass of the admin password and one could do
// changes to the system settings without even being logged into Admin Panel.
// After relogin the user can simply click back in browser and their input will
// still be there so nothing is lost
if (!check_admin_pass('')) {
	require_once "footer.php";
	exit;
}