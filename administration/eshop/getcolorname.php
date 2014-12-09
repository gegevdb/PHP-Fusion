<?php
/*--------------------------------------------------------------+
| PHP-Fusion Content Management System 				|
| Copyright � 2002 - 2008 Nick Jones 				|
| http://www.php-fusion.co.uk/ 					|
+---------------------------------------------------------------+
| Author: Joakim Falk (Domi) 					|
+--------------------------------------------------------------*/
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
require_once "../../../maincore.php";
header("Content-type: text/html; charset=ISO-8859-9");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");  // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");        // HTTP/1.0

include LOCALE.LOCALESET."eshop.php";
if (isset($_GET['cid']) && !isnum($_GET['cid'])) die("Denied");

$itemid = stripinput($_GET['cid']);

function getcolorname($id) {
global $ESHPCLRS;

	$id = "{$ESHPCLRS[$id]}";
	return $id;

	}
	echo getcolorname($itemid);
}
exit;
?>