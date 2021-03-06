<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------*
| Filename: administration/admin_icons.php
| Author: Frederick MC Chan
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (!defined("IN_FUSION")) {
	die("Access Denied");
}
/**
 * Class Admin
 * This class is called in templates/admin_header.php
 * Determine how to we set variables on 3rd party script
 *
 */

class Admin {
	/**
	 * @var array
	 */
	public $admin_page_icons = array(
		'0' => "<i class='fa fa-fw fa-dashboard'></i>",
		'1' => "<i class='fa fa-fw fa-microphone'></i>",
		'2' => "<i class='fa fa-fw fa-users'></i>",
		'3' => "<i class='fa fa-fw fa-cog'></i>",
		'4' => "<i class='fa fa-fw fa-wrench'></i>",
		'5' => "<i class='fa fa-fw fa-cubes'></i>"
	);
	// pair via admin rights - set the base here now.

	/**
	 * @var array
	 */
	public $admin_link_icons = array(
		'AC' => "<i class='admin-ico fa fa-fw fa-book'></i>", // articles categories
		'A' => "<i class='admin-ico fa fa-fw fa-book'></i>", // articles
		'BLOG' => "<i class='admin-ico fa fa-fw fa-graduation-cap'></i>", // blog
		'BLC' => "<i class='admin-ico fa fa-fw fa-graduation-cap'></i>", // blog categories
		'CP' => "<i class='admin-ico fa fa-fw fa-leaf'></i>", // custom page
		'DC' => "<i class='admin-ico fa fa-fw fa-cloud-download'></i>", // download categories
		'D' => "<i class='admin-ico fa fa-fw fa-cloud-download'></i>", // downloads
		'ESHP' => "<i class='admin-ico fa fa-fw fa-shopping-cart'></i>", // eshop
		'FQ' => "<i class='admin-ico fa fa-fw fa-life-buoy'></i>", // frequent asked questions
		'F' => "<i class='admin-ico fa fa-fw fa-comment-o'></i>", // forum
		'IM' => "<i class='admin-ico fa fa-fw fa-picture-o'></i>", // Images
		'N' => "<i class='admin-ico fa fa-fw fa-newspaper-o'></i>", // news
		'NC' => "<i class='admin-ico fa fa-fw fa-newspaper-o'></i>", // news categories
		'PM' => "<i class='admin-ico fa fa-fw fa-envelope-o'></i>", // private message
		'PH' => "<i class='admin-ico fa fa-fw fa-camera-retro'></i>", // photo album ?
		'PO' => "<i class='admin-ico fa fa-fw fa-bar-chart'></i>", // Poll
		'WC' => "<i class='admin-ico fa fa-fw fa-sitemap'></i>", // weblink cats
		'W' => "<i class='admin-ico fa fa-fw fa-sitemap'></i>", // weblinks
		'APWR' => "<i class='admin-ico fa fa-fw fa-medkit'></i>", // Admin Password Reset
		'AD' => "<i class='admin-ico fa fa-fw fa-user-md'></i>", // Administrator
		'B' => "<i class='admin-ico fa fa-fw fa-ban'></i>", // Blacklist
		'FR' => "<i class='admin-ico fa fa-fw fa-gavel'></i>", // Forum Ranks
		'M' => "<i class='admin-ico fa fa-fw fa-user'></i>", // Members
		'MI' => "<i class='admin-ico fa fa-fw fa-barcode'></i>", // Migration tool
		'SU' => "<i class='admin-ico fa fa-fw fa-file-o'></i>", // User Submissions
		'UF' => "<i class='admin-ico fa fa-fw fa-table'></i>", // User Fields
		'UG' => "<i class='admin-ico fa fa-fw fa-users'></i>", // user groups
		'UL' => "<i class='admin-ico fa fa-fw fa-coffee'></i>", // user logs
		'SB' => "<i class='admin-ico fa fa-fw fa-language'></i>", // Banners
		'BB' => "<i class='admin-ico fa fa-fw fa-bold'></i>", // Bbcode
		'DB' => "<i class='admin-ico fa fa-fw fa-history'></i>", // database backup
		'MAIL' => "<i class='admin-ico fa fa-fw fa-send'></i>", // Email templates
		'ERRO' => "<i class='admin-ico fa fa-fw fa-bug'></i>", // Error Logs
		'I' => "<i class='admin-ico fa fa-fw fa-cubes'></i>", // Infusions
		'P' => "<i class='admin-ico fa fa-fw fa-desktop'></i>", // Panels
		'PL' => "<i class='admin-ico fa fa-fw fa-puzzle-piece'></i>", // Permalink
		'PI' => "<i class='admin-ico fa fa-fw fa-info-circle'></i>", // php Info
		'ROB' => "<i class='admin-ico fa fa-fw fa-android'></i>", // robots.txt
		'SL' => "<i class='admin-ico fa fa-fw fa-link'></i>", // Site Links
		'SM' => "<i class='admin-ico fa fa-fw fa-smile-o'></i>", // Smileys
		'TS' => "<i class='admin-ico fa fa-fw fa-magic'></i>", // Theme
		'U' => "<i class='admin-ico fa fa-fw fa-database'></i>", // Upgrade
		'LANG' => "<i class='admin-ico fa fa-fw fa-flag'></i>", // Language Settings
		'S1' => "<i class='admin-ico fa fa-fw fa-hospital-o'></i>", // Main Settings
		'S2' => "<i class='admin-ico fa fa-fw fa-clock-o'></i>", // Time and Date
		'S3' => "<i class='admin-ico fa fa-fw fa-comments-o'></i>", // Forum Settings
		'S4' => "<i class='admin-ico fa fa-fw fa-key'></i>", // Registration Settings
		'S5' => "<i class='admin-ico fa fa-fw fa-camera-retro'></i>", // Photo Gallery Settings
		'S6' => "<i class='admin-ico fa fa-fw fa-gears'></i>", // Miscellaneous Settings
		'S7' => "<i class='admin-ico fa fa-fw fa-envelope-square'></i>", // PM Settings
		'S8' => "<i class='admin-ico fa fa-fw fa-newspaper-o'></i>", // News Settings
		'S9' => "<i class='admin-ico fa fa-fw fa-users'></i>", // User Management
		'S10' => "<i class='admin-ico fa fa-fw fa-arrow-circle-up'></i>", // Items Per Page
		'S11' => "<i class='admin-ico fa fa-fw fa-cloud-download'></i>", // Download Settings
		'S12' => "<i class='admin-ico fa fa-fw fa-shield'></i>", // Security Settings
		'S13' => "<i class='admin-ico fa fa-fw fa-graduation-cap'></i>", // Blog Settings
	);
	/**
	 * @var array
	 */
	private $admin_pages = array();
	/**
	 * @var array
	 */
	private $pages = array(1 => FALSE, 2 => FALSE, 3 => FALSE, 4 => FALSE, 5 => FALSE);
	/**
	 *    Constructor class. No Params
	 */
	private $current_page = '';

	/**
	 * Replace admin page icons
	 * @param array $admin_page_icons
	 */
	public function setAdminPageIcons($page, $icons) {
		if (isset($this->admin_page_icons[$page])) {
			$this->admin_page_icons[$page] = $icons;
		}
	}

	/**
	 * HOW COME GIT DONT HAVE THIS FUNCTION? 
	 * @param array $admin_link_icons
	 */
	public function setAdminLinkIcons($rights, $icons) {
		$this->admin_link_icons[$rights] = $icons;
	}

	// add a setter for icons
	public function __construct() {
		global $locale, $pages, $admin_pages;
		@list($title) = dbarraynum(dbquery("SELECT admin_title FROM ".DB_ADMIN." WHERE admin_link='".FUSION_SELF."'"));
		add_to_title($locale['global_200'].$locale['global_123'].($title ? $locale['global_201'].$title : ""));
		$this->admin_pages = $admin_pages;
		$this->pages = $pages;
		$this->current_page = self::_currentPage();
	}

	/**
	 * @param $admin_rights
	 * @return bool|string
	 */
	public function get_admin_icons($admin_rights) {
		// admin rights might not yield an icon & admin_icons override might not have the key.
		if (isset($this->admin_link_icons[$admin_rights]) && $this->admin_link_icons[$admin_rights]) {
			return $this->admin_link_icons[$admin_rights];
		}
		return FALSE;
	}

	/**
	 * @param $page_number
	 * @return string
	 */
	public function get_admin_page_icons($page_number) {
		if (isset($this->admin_page_icons[$page_number]) && $this->admin_page_icons[$page_number]) {
			return $this->admin_page_icons[$page_number];
		}
	}

	/**
	 * @return string
	 */
	public function vertical_admin_nav() {
		global $aidlink, $locale;
		$html = "<ul id='adl' class='admin-vertical-link'>\n";
		for ($i = 0; $i < 6; $i++) {
			$result = dbquery("SELECT * FROM ".DB_ADMIN." WHERE admin_page='".$i."' AND admin_link !='reserved' ORDER BY admin_title ASC");
			$active = (isset($_GET['pagenum']) && $_GET['pagenum'] == $i || !isset($_GET['pagenum']) && $this->_isActive() == $i) ? 1 : 0;
			$html .= "<li class='".($active ? 'active panel' : 'panel')."' >\n";
			if ($i == 0) {
				$html .= "<a class='adl-link' href='".ADMIN."index.php".$aidlink."&amp;pagenum=0'>".$this->get_admin_page_icons($i)." ".$locale['ac0'.$i]." ".($i > 0 ? "<span class='adl-drop pull-right'></span>" : '')."</a>\n";
			} else {
				$html .= "<a class='adl-link ".($active ? '' : 'collapsed')."' data-parent='#adl' data-toggle='collapse' href='#adl-$i'>".$this->get_admin_page_icons($i)." ".$locale['ac0'.$i].($i == 5 ? " (".dbrows($result).")" : "")." ".($i > 0 ? "<span class='adl-drop pull-right'></span>" : '')."</a>\n";
				$html .= "<div id='adl-$i' class='collapse ".($active ? 'in' : '')."'>\n";
				if (dbrows($result) > 0) {
					$html .= "<ul class='admin-submenu'>\n";
					while ($data = dbarray($result)) {
						$secondary_active = $data['admin_link'] == $this->current_page ? "class='active'" : '';
						$icons = $this->get_admin_icons($data['admin_rights']);
						$title = $data['admin_title'];
						if ($data['admin_page'] !== 5) {
							$title = isset($locale[$data['admin_rights']]) ? $locale[$data['admin_rights']] : $data['admin_title'];
						}
						$html .= checkrights($data['admin_rights']) ? "<li $secondary_active><a href='".ADMIN.$data['admin_link'].$aidlink."'>".$icons.$title."</a></li>\n" : "";
					}
					$html .= "</ul>\n";
				}
				$html .= "</div>\n";
				$html .= "</li>\n";
			}
		}
		$html .= "</ul>\n";
		return $html;
	}

	/**
	 * Build a return that always synchronize with the DB_ADMIN url.
	 * by Hien
	 */
	private function _currentPage() {
		$path_info = pathinfo(START_PAGE);
		if (stristr(FUSION_REQUEST, '/administration/')) {
			$path_info = $path_info['filename'].'.php';
		} else {
			$path_info = '../'.$path_info['dirname'].'/'.$path_info['filename'].'.php';
		}
		return $path_info;
	}

	/**
	 * @return int|string
	 */
	public function _isActive() {
		foreach ($this->admin_pages as $key => $data) {
			$data_link = array_flip($data);
			if (isset($data_link[$this->current_page])) {
				return $key;
			}
		}
		return '0';
	}

	public function horiziontal_admin_nav() {
		global $aidlink, $locale;
		$html = "<ul class='admin-horizontal-link'>\n";
		for ($i = 0; $i < 6; $i++) {
			if ($i < 5 || $i == 5 && dbcount("(inf_id)", DB_INFUSIONS, "")) {
				$active = (isset($_GET['pagenum']) && $_GET['pagenum'] == $i || !isset($_GET['pagenum']) && $this->_isActive() == $i) ? 1 : 0;
				$html .= "<li ".($active ? "class='active'" : '')."><a href='".ADMIN.$aidlink."&amp;pagenum=$i'>".$this->get_admin_page_icons($i)." ".$locale['ac0'.$i]."</a></li>\n";
			}
		}
		$html .= "</ul>\n";
		return $html;
	}
}