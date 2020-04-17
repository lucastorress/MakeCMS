<?php
/*=========================================================
| HabboRetro ~ CMSE - Content Management Systems Expert
| #########################################################
| HabboRetro release_4 Developed by bil & Meth0d
| Parts by Sisija and bil
| Visit Meth0d.org , Portal-Habbo.com.br
| #########################################################
| Cms developed to improve the delivery system of your
| habbo private if you have questions, suggestions or any
| bugs reportal please contact: gabriel_bil123@hotmail.com
| #########################################################
| Content license: Creative Commons 3.0 BY
| Code license: Apache License 2.0
\=========================================================*/

define('TAB_ID', 6);
define('PAGE_ID', 11);

require_once "global.php";

$tpl->Init();

$tpl->AddGeneric('head-init');

$tpl->AddIncludeSet('generic');
$tpl->AddIncludeFile(new IncludeFile('text/css', 'http://host.portal-habbo.com.br/habboweb/%web_build%/web-gallery/v2/styles/newcredits.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', 'http://host.portal-habbo.com.br/habboweb/%web_build%/web-gallery/static/js/newcredits.js'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', '%www%/js/full_ajax.js'));
$tpl->WriteIncludeFiles();

$tpl->AddGeneric('head-overrides-generic');
$tpl->AddGeneric('head-bottom');
$tpl->AddGeneric('generic-top');

$tpl->Write('<div id="column1" class="column">');
$tpl->AddGeneric('comp-club-teaser');
$tpl->Write('</div>');

$tpl->Write('<div id="column2" class="column">');
$tpl->AddGeneric('comp-club-membership');
$tpl->Write('</div>');

$tpl->AddGeneric('generic-column3');
$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', ' Club');
$tpl->SetParam('body_id', 'home');

$tpl->Output();

?>
