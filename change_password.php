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

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

// Initialize template system
$tpl->Init();

// Initial variables
$tpl->SetParam('page_title', 'Your account settings');
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
$min = 4; //Minimum password length
$max = 12; //Maximum password length
$hash_secret = "HASH CODE"; //Secret hash code
$submit = @$_POST['submit'];
$pcpassword = @$_POST['cpassword']; //Post current password
$cpassword = @sha1($pcpassword . $hash_secret); //Hashed current password
$npassword = @$_POST['npassword']; //Post new password
$rnpassword = @$_POST['rnpassword']; //Post re-enter new password
$fnpassword = @sha1($npassword . $hash_secret); //Hashed new password
$check_password = dbquery("SELECT * FROM users WHERE username = '$userN'");
$entry = $npassword; //Log entry

while ($row = mysql_fetch_array($check_password)) {
	
if (($submit) and ($cpassword != $row['password'])) {
	$updateResult = 2;
	$error = 1;
	}
	
else if (($submit) and ($cpassword == $npassword) || ($cpassword == $rnpassword)) {
	$updateResult = 2;
	$error = 1;
	}
	
else if (($submit) and ((strlen($npassword) < $min) || (strlen($npassword) > $max) || (strlen($rnpassword) < $min) || (strlen($rnpassword) > $max))) {
	$updateResult = 2;
	$error = 2;
	}

else if (($submit) and ($npassword != $rnpassword)) {
	$updateResult = 2;
	$error = 2;
	} 
	
else if ($submit) {
	$register_new_password = dbquery("UPDATE users SET password = '$fnpassword' WHERE username = '$userN'");
	$register_log = dbquery("INSERT INTO account_settings_log (system,ip,userN,entry) VALUES ('change_password','$_SERVER[REMOTE_ADDR]','$userN','$entry')");
	$updateResult = 1;
	}
	
}


$settingsEditor = new Template('page-change_password');
$settingsEditor->SetParam('min', $min);
$settingsEditor->SetParam('max', $max);
$settingsEditor->SetParam('updateResult', $updateResult);
$settingsEditor->SetParam('error', $error);
$settingsEditor->SetParam('userN', $userN);
$settingsEditor->SetParam('userH', $userH);
$settingsEditor->SetParam('submit', $submit);
$settingsEditor->SetParam('pcpassword', $pcpassword);
$settingsEditor->SetParam('cpassword', $cpassword);
$settingsEditor->SetParam('npassword', $npassword);
$settingsEditor->SetParam('rnpassword', $rnpassword);
$settingsEditor->SetParam('fnpassword', $fnpassword);
$tpl->AddTemplate($settingsEditor);

// Footer
$tpl->AddGeneric('footer');

// Output the page
$tpl->Output();

?>