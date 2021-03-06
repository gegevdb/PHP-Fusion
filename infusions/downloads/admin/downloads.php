<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: admin/downloads.php
| Author: Frederick MC Chan (Hien)
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
/* Download Form */
if (fusion_get_settings("tinymce_enabled")) {
	echo "<script language='javascript' type='text/javascript'>advanced();</script>\n";
}

$data = array(
	'download_id' => 0,
	'download_user' => $userdata['user_id'],
	'download_homepage' => '',
	'download_title' => '',
	'download_cat' => 0,
	'download_description_short' => '',
	'download_description' => '',
	'download_keywords' => '',
	'download_image_thumb' => '',
	'download_url' => '',
	'download_file' => '',
	'download_license' => '',
	'download_copyright' => '',
	'download_os' => '',
	'download_version' => '',
	'download_filesize' => '',
	'download_visibility' => 0,
	'download_allow_comments' => 0,
	'download_allow_ratings' => 0,
	'download_datestamp' => time()
);

/* Delete Screenshot, Delete Files */
if ((isset($_GET['action']) && $_GET['action'] == "delete") && (isset($_GET['download_id']) && isnum($_GET['download_id']))) {
	$result = dbquery("SELECT download_file, download_image, download_image_thumb FROM ".DB_DOWNLOADS." WHERE download_id='".$_GET['download_id']."'");
	if (dbrows($result)) {
		$data = dbarray($result);
		if (!empty($data['download_file']) && file_exists(DOWNLOADS.$data['download_file'])) {
			@unlink(DOWNLOADS.$data['download_file']);
		}
		if (!empty($data['download_image']) && file_exists(DOWNLOADS."images/".$data['download_image'])) {
			@unlink(DOWNLOADS."images/".$data['download_image']);
		}
		if (!empty($data['download_image_thumb']) && file_exists(DOWNLOADS."images/".$data['download_image_thumb'])) {
			@unlink(DOWNLOADS."images/".$data['download_image_thumb']);
		}
		$result = dbquery("DELETE FROM ".DB_DOWNLOADS." WHERE download_id='".$_GET['download_id']."'");
	}
	addNotice("warning", $locale['download_0102']);
	redirect(FUSION_SELF.$aidlink."&download_cat_id=".intval($_GET['download_cat_id']));
}

/* save */
if (isset($_POST['save_download'])) {
	$data = array(
		'download_id' => form_sanitizer($_POST['download_id'], '0', 'download_id'),
		'download_user' => $userdata['user_id'],
		'download_homepage' => form_sanitizer($_POST['download_homepage'], '', 'download_homepage'),
		'download_title' => form_sanitizer($_POST['download_title'], '', 'download_title'),
		'download_cat' => form_sanitizer($_POST['download_cat'], '0', 'download_cat'),
		'download_description_short' => form_sanitizer($_POST['download_description_short'], '', 'download_description_short'),
		'download_description' => form_sanitizer($_POST['download_description'], '', 'download_description'),
		'download_keywords' => form_sanitizer($_POST['download_keywords'], '', 'download_keywords'),
		'download_image' => isset($_POST['download_image']) ? form_sanitizer($_POST['download_image'], '', 'download_image') : '',
		'download_image_thumb' => isset($_POST['download_image_thumb']) ? form_sanitizer($_POST['download_image_thumb'], '', 'download_image_thumb') : '',
		'download_file' => isset($_POST['download_file']) ? form_sanitizer($_POST['download_file'], '', 'download_file') : '',
		'download_license' => form_sanitizer($_POST['download_license'], '', 'download_license'),
		'download_copyright' => form_sanitizer($_POST['download_copyright'], '', 'download_copyright'),
		'download_os' => form_sanitizer($_POST['download_os'], '', 'download_os'),
		'download_version' => form_sanitizer($_POST['download_version'], '', 'download_version'),
		'download_filesize' => form_sanitizer($_POST['download_filesize'], '', 'download_filesize'),
		'download_visibility' => form_sanitizer($_POST['download_visibility'], '0', 'download_visibility'),
		'download_allow_comments' => isset($_POST['download_allow_comments']) ? 1 : 0,
		'download_allow_ratings' => isset($_POST['download_allow_ratings']) ? 1 : 0,
		'download_datestamp' => isset($_POST['update_datestamp']) ? time() : $data['download_datestamp']
	);

	/* Delete File */
	if (isset($_POST['del_upload']) && isset($_GET['download_id']) && isnum($_GET['download_id'])) {
		$result2 = dbquery("SELECT download_file FROM ".DB_DOWNLOADS." WHERE download_id='".$_GET['download_id']."'");
		if (dbrows($result2)) {
			$data2 = dbarray($result2);
			if (!empty($data2['download_file']) && file_exists(DOWNLOADS.'files/'.$data2['download_file'])) {
				@unlink(DOWNLOADS.'files/'.$data2['download_file']);
			}
			$data['download_file'] = '';
			$data['download_filesize'] = '';
		}
	}

	/** Bugs with having Link and File together -- File will take precedence **/
	if ($defender::safe() && !empty($_FILES['download_file']['name']) && is_uploaded_file($_FILES['download_file']['tmp_name'])) {

		$upload = form_sanitizer($_FILES['download_file'], '', 'download_file');
		if ($upload['error'] == 0) {
			$data['download_file'] = isset($upload['target_file']) ? $upload['target_file'] : $upload['image_name'];
			if ($data['download_filesize'] == "" || isset($_POST['calc_upload'])) {
				$data['download_filesize'] = parsebytesize($upload['source_size']);
			}
		}
	} elseif (!empty($_POST['download_url']) && empty($data['download_file'])) {
		// must have download url.
		$data['download_url'] = form_sanitizer($_POST['download_url'], "", "download_url");
		$data['download_file'] = '';
	} elseif (empty($data['download_file']) && empty($data['download_url'])) {
			$defender->stop();
			addNotice('danger', $locale['download_0111']);
	}
	/**
	 * Image Section
	 */
	if ($defender::safe() && isset($_POST['del_image']) && isset($_GET['download_id']) && isnum($_GET['download_id'])) {
		$result = dbquery("SELECT download_image, download_image_thumb FROM ".DB_DOWNLOADS." WHERE download_id='".$_GET['download_id']."'");
		if (dbrows($result)) {
			$data += dbarray($result);
			if (!empty($data['download_image']) && file_exists(DOWNLOADS."images/".$data['download_image'])) {
				@unlink(DOWNLOADS."images/".$data['download_image']);
			}
			if (!empty($data['download_image_thumb']) && file_exists(DOWNLOADS."images/".$data['download_image_thumb'])) {
				@unlink(DOWNLOADS."images/".$data['download_image_thumb']);
			}
		}
		$data['download_image'] = '';
		$data['download_image_thumb'] = '';
	}
	elseif ($defender::safe() && !empty($_FILES['download_image']['name']) && is_uploaded_file($_FILES['download_image']['tmp_name'])) {
		$upload = form_sanitizer($_FILES['download_image'], '', 'download_image');
		if ($upload['error'] == 0) {
			$data['download_image'] = $upload['image_name'];
			$data['download_image_thumb'] = $upload['thumb1_name'];
		}
	}
	if (dbcount("(download_id)", DB_DOWNLOADS, "download_id='".$data['download_id']."'")) {
		dbquery_insert(DB_DOWNLOADS, $data, 'update');
		if ($defender::safe()) {
			addNotice("success", $locale['download_0101']);
			redirect(FUSION_SELF.$aidlink);
		}
	} else {
		dbquery_insert(DB_DOWNLOADS, $data, 'save');
		if ($defender::safe()) {
			addNotice("success", $locale['download_0100']);
			redirect(FUSION_SELF.$aidlink);
		}
	}
}


if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['download_id']) && isnum($_GET['download_id']))) {
	$result = dbquery("SELECT * FROM ".DB_DOWNLOADS." WHERE download_id='".intval($_GET['download_id'])."'");
	if (dbrows($result)) {
		$data = dbarray($result);
	} else {
		redirect(FUSION_SELF.$aidlink);
	}
}

echo openform('inputform', 'post', FUSION_REQUEST, array('enctype' => 1));
echo "<div class='row'>\n";
echo "<div class='col-xs-12 col-sm-8'>\n";
openside('');
echo form_hidden('download_id', '', $data['download_id']);
echo form_hidden('download_datestamp', '', $data['download_datestamp']);
echo form_text('download_title', $locale['download_0200'], $data['download_title'], array(
								   'required' => TRUE,
								   "inline" => TRUE,
								   'error_text' => $locale['download_0110']
							   ));
echo form_textarea('download_description_short', $locale['download_0202'], $data['download_description_short'], array(
												   'required' => TRUE,
												   "inline" => TRUE,
												   'error_text' => $locale['download_0112'],
												   'maxlength' => '255',
												   'autosize' => fusion_get_settings("tinymce_enabled") ? FALSE : TRUE
											   ));
echo form_select('download_keywords', $locale['download_0203'], $data['download_keywords'], array(
										"placeholder" => $locale['download_0203a'],
										'max_length' => 320,
										"inline" => TRUE,
										'width' => '100%',
										'tags' => 1,
										'multiple' => 1
									));
closeside();
echo "<div class='well'>\n";
echo $locale['download_0204'];
echo "</div>\n";
/* Download file input */
$tab_title['title'][] = "1 -".$locale['download_0214'];
$tab_title['id'][] = 'dlf';
$tab_title['icon'][] = 'fa fa-file-zip-o fa-fw';
$tab_title['title'][] = "2 -".$locale['download_0215'];
$tab_title['id'][] = 'dll';
$tab_title['icon'][] = 'fa fa-plug fa-fw';
$tab_active = tab_active($tab_title, 0);
echo opentab($tab_title, $tab_active, 'downloadtab');
echo opentabbody($tab_title['title'][0], 'dlf', $tab_active);
if (!empty($data['download_file'])) {
	echo "<div class='list-group-item m-t-10'>".$locale['download_0214']." - <a href='".DOWNLOADS.$data['download_file']."'>".DOWNLOADS.$data['download_file']."</a>\n";
	echo form_checkbox('del_upload', $locale['download_0216'], '', array('class' => 'm-b-0'));
	echo "</div>\n";
	echo form_hidden('download_file', '', $data['download_file']);
} else {
	$file_options = array(
		"class" => "m-t-10",
		"required" => TRUE,
		"width" => "100%",
		"upload_path" => DOWNLOADS."files/",
		"max_bytes" => $dl_settings['download_max_b'],
		"valid_ext" => $dl_settings['download_types'],
		"error_text" => $locale['download_0115'],
	);
	echo form_fileinput('download_file', $locale['download_0214'], "", $file_options);
	echo sprintf($locale['download_0218'], parsebytesize($dl_settings['download_max_b']), str_replace(',', ' ', $dl_settings['download_types']))."<br />\n";
	echo form_checkbox('calc_upload', $locale['download_0217'], '');
}
echo closetabbody();
echo opentabbody($tab_title['title'][1], 'dll', $tab_active);
if (empty($data['download_file'])) {
	echo form_text('download_url', $locale['download_0206'], $data['download_url'], array(
		"required" => TRUE,
		"class" => "m-t-10",
		"inline" => TRUE,
		"placeholder" => "http://",
		"error_text" => $locale['download_0116']
	));
} else {
	echo form_hidden('download_url', '', $data['download_url']);
}
echo closetabbody();
echo closetab();
echo "<hr/>\n";
echo form_textarea('download_description', $locale['download_0202a'], $data['download_description'], array(
											 "no_resize" => TRUE,
											 "form_name" => "inputform",
											 "html" => fusion_get_settings("tinymce_enabled") ? FALSE : TRUE,
											 "autosize" => fusion_get_settings("tinymce_enabled") ? FALSE : TRUE,
											 "preview" => fusion_get_settings("tinymce_enabled") ? FALSE : TRUE,
											 "placeholder" => $locale['download_0201']
										 ));
echo "</div>\n<div class='col-xs-12 col-sm-4'>\n";
openside();
if ($settings['comments_enabled'] == "0" || $settings['ratings_enabled'] == "0") {
	$sys = "";
	if ($settings['comments_enabled'] == "0" && $settings['ratings_enabled'] == "0") {
		$sys = $locale['comments_ratings'];
	} elseif ($settings['comments_enabled'] == "0") {
		$sys = $locale['comments'];
	} else {
		$sys = $locale['ratings'];
	}
	echo "<div class='well'>".sprintf($locale['download_0256'], $sys)."</div>\n";
}
echo form_select_tree("download_cat", $locale['download_0207'], $data['download_cat'], array(
	"no_root" => 1,
	"placeholder" => $locale['choose'],
	'width' => '100%',
	"query" => (multilang_table("DL") ? "WHERE download_cat_language='".LANGUAGE."'" : "")
), DB_DOWNLOAD_CATS, "download_cat_name", "download_cat_id", "download_cat_parent");
echo form_select('download_visibility', $locale['download_0205'], $data['download_visibility'], array(
	'options' => fusion_get_groups(),
	'placeholder' => $locale['choose'],
	'width' => '100%'
));
if ($dl_settings['download_screenshot']) {
	if (!empty($data['download_image']) && !empty($data['download_image_thumb'])) {
		echo "<div class='clearfix list-group-item m-b-20'>\n";
		echo "<div class='pull-left m-r-10'>\n";
		echo thumbnail(DOWNLOADS."images/".$data['download_image_thumb'], '80px');
		echo "</div>\n";
		echo "<div class='overflow-hide'>\n";
		echo "<span class='text-dark strong'>".$locale['download_0220']."</span>\n";
		echo form_checkbox('del_image', $locale['download_0216'], '');
		echo form_hidden('download_image', '', $data['download_image']);
		echo form_hidden('download_image_thumb', '', $data['download_image_thumb']);
		echo "</div>\n</div>\n";
	} else {
		require_once INCLUDES."mimetypes_include.php";
		$file_options = array(
			'upload_path' => DOWNLOADS."images/",
			'max_width' => $dl_settings['download_screen_max_w'],
			'max_height' => $dl_settings['download_screen_max_w'],
			'max_byte' => $dl_settings['download_screen_max_b'],
			'type' => 'image',
			'delete_original' => 0,
			'thumbnail_folder' => '',
			'thumbnail' => 1,
			'thumbnail_suffix' => '_thumb',
			'thumbnail_w' => $dl_settings['download_thumb_max_w'],
			'thumbnail_h' => $dl_settings['download_thumb_max_h'],
			'thumbnail2' => 0,
			'valid_ext' => implode('.', array_keys(img_mimeTypes())),
			"width" => "100%",
			"template" => "modern",
		);
		echo form_fileinput('download_image', $locale['download_0220'], '', $file_options); // all file types.
		echo "<div class='m-b-10'>".sprintf($locale['download_0219'], parsebytesize($dl_settings['download_screen_max_b']), str_replace(',', ' ', ".jpg,.gif,.png"), $dl_settings['download_screen_max_w'], $dl_settings['download_screen_max_h'])."</div>\n";
	}
}
echo form_button('save_download', $locale['download_0212'], $locale['download_0212'], array(
									'class' => 'btn-success m-r-10',
									'icon' => 'fa fa-check-square-o'
								));
closeside();
openside('');
echo form_checkbox('download_allow_comments', $locale['download_0223'], $data['download_allow_comments'], array('class' => 'm-b-0'));
echo form_checkbox('download_allow_ratings', $locale['download_0224'], $data['download_allow_ratings'], array('class' => 'm-b-0'));
if (isset($_GET['action']) && $_GET['action'] == "edit") {
	echo form_checkbox('update_datestamp', $locale['download_0213'], '', array('class' => 'm-b-0'));
}
closeside();
openside();
echo form_text('download_license', $locale['download_0208'], $data['download_license'], array('inline' => 1));
echo form_text('download_copyright', $locale['download_0222'], $data['download_copyright'], array('inline' => 1));
echo form_text('download_os', $locale['download_0209'], $data['download_os'], array('inline' => 1));
echo form_text('download_version', $locale['download_0210'], $data['download_version'], array('inline' => 1));
echo form_text('download_homepage', $locale['download_0221'], $data['download_homepage'], array('inline' => 1));
echo form_text('download_filesize', $locale['download_0211'], $data['download_filesize'], array('inline' => 1));
closeside();
echo "</div>\n</div>\n"; // end row.
echo "<div class='m-t-20'>\n";
echo form_button('save_download', $locale['download_0212'], $locale['download_0212'], array(
	'class' => 'btn-success m-r-10',
	'icon' => 'fa fa-check-square-o'
));
if (isset($_GET['action']) && $_GET['action'] == "edit") {
	echo "<button type='reset' name='reset' value='".$locale['download_0225']."' class='button btn btn-default' onclick=\"location.href='".FUSION_SELF.$aidlink."';\"/>".$locale['download_0225']."</button>";
}
echo "</div>\n";
echo closeform();