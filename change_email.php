<?php
/*=======================================================================
| MakeCMS - Sistema avançado de Administração de CMS
| #######################################################################
| Copyright (c) 2010, Lucas Torres and Meth0d
| #######################################################################
| Este programa é um Free Software aonde você pode editar os conteúdos
| com os direitos autorais do editor.
| #######################################################################
| Contato:
|         lucastorres.ce@gmail.com / sonhador_br@live.com
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
$tpl->SetParam('page_title', 'Preferências');
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