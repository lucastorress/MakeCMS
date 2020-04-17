<?php
/*=======================================================================
| MakeCMS - A content management system for Habbo retro based on UberCMS
| #######################################################################
| Copyright (c) 2010, Roy 'Meth0d' & Lucas Torres (https://github.com/lucastorress)
| http://www.meth0d.org / https://www.sulake.com
| #######################################################################
| This program is free software: you can redistribute it and/or modify
| it under the terms of the GNU General Public License as published by
| the Free Software Foundation, either version 3 of the License, or
| (at your option) any later version.
| #######################################################################
| This program is distributed in the hope that it will be useful,
| but WITHOUT ANY WARRANTY; without even the implied warranty of
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
| GNU General Public License for more details.
\======================================================================*/

define('TAB_ID', 1);
define('PAGE_ID', 4);

require_once "global.php";
require_once "inc/class.mutant.php";
require_once "inc/class.core.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

// Initialize template system
$tpl->Init();

// Initial variables
$tpl->SetParam('page_title', 'Prefer�ncias');
$tpl->SetParam('body_id', 'profile');

// Generate page header
$tpl->AddGeneric('head-init');
$tpl->AddIncludeSet('generic');
$tpl->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/settings.js'));
$tpl->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/settings.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/friendmanagement.css', 'stylesheet'));
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head-overrides-generic');
$tpl->AddGeneric('head-bottom');

// Generate generic top/navigation/login box
$tpl->AddGeneric('generic-top');

// Navigation
$settingsNavi = new Template('comp-settings-navi');
$tpl->AddTemplate($settingsNavi);

// Content
$updateResult = 0;
$error = 0;
$hash_secret = "HASH CODE"; //Secret hash code
$submit = @$_POST['submit'];
$pcpassword = @$_POST['cpassword']; //Post current password
$cpassword = @sha1($pcpassword . $hash_secret); //Hashed current password
$nemail = @$_POST['nemail']; //Post new email
$rnemail = @$_POST['rnemail']; //Post re-enter new email
$fnemail = @mysql_real_escape_string(stripslashes(trim($nemail)));
$check_password = dbquery("SELECT * FROM users WHERE username = '$userN'");
$entry = $rnemail; //Log entry

while ($row = mysql_fetch_array($check_password)) {
	
if (($submit) and ($cpassword != $row['password'])) {
	$updateResult = 2;
	$error = 1;
	}
	
else if (($submit) and ((strlen($nemail) == 0) || (strlen($rnemail) == 0))) {
	$updateResult = 2;
	$error = 2;
	}

else if (($submit) and ($nemail != $rnemail)) {
	$updateResult = 2;
	$error = 2;
	} 
	
else if ($submit) {
	$register_new_email = dbquery("UPDATE users SET mail = '$fnemail' WHERE username = '$userN'");
	$register_log = dbquery("INSERT INTO account_settings_log (system,ip,userN,entry) VALUES ('change_email','$_SERVER[REMOTE_ADDR]','$userN','$entry')");
	$updateResult = 1;
	}
	
}


$settingsEditor = new Template('page-change_email');
$settingsEditor->SetParam('updateResult', $updateResult);
$settingsEditor->SetParam('error', $error);
$settingsEditor->SetParam('userN', $userN);
$settingsEditor->SetParam('userH', $userH);
$settingsEditor->SetParam('submit', $submit);
$settingsEditor->SetParam('pcpassword', $pcpassword);
$settingsEditor->SetParam('cpassword', $cpassword);
$settingsEditor->SetParam('nemail', $nemail);
$settingsEditor->SetParam('rnemail', $rnemail);
$tpl->AddTemplate($settingsEditor);

// Footer
$tpl->AddGeneric('footer');

// Output the page
$tpl->Output();

?>