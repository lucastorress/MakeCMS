<?php
/*=======================================================================
| UberCMS - Advanced Website and Content Management System for uberEmu
| #######################################################################
| Copyright (c) 2010, Roy 'Meth0d' and updates by Matthew 'MDK'
| http://www.meth0d.org & http://www.sulake.biz
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

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN)
{
	exit;
}

if (!$users->hasFuse(HK_USER_ID, 'fuse_admin'))
{
	die("admins only");
}

if (isset($_POST['submit']))
{
	$content = filter($_POST['content']);
	$ins = dbquery("INSERT INTO `notes` (content,date) VALUES ('" . $content . "','" . date('j F Y h:i') . "')");
	header("Location: index.php?_cmd=todo");
}

if (isset($_GET['del']) && is_numeric($_GET['del']))
{
	dbquery("DELETE FROM notes WHERE id = '" . intval($_GET['del']) . "' LIMIT 1");
	header("Location: index.php?_cmd=todo");
}

require_once "top.php";

?>

<h1>Agenda de programações</h1>

<?php

$getNotes = dbquery("SELECT id,content,date FROM notes ORDER BY id DESC");

while ($n = mysql_fetch_assoc($getNotes))
{
	echo '<div style="border: 1px solid; margin-top: 20px; margin-bottom: 20px; margin-left: 5px; margin-right: 20px;">';
	echo '<div style="margin: 1px; padding: 5px; background-color: #E0E0F8;">' . $n['date'] . '&nbsp;&nbsp;<small>(<a href="index.php?_cmd=todo&del=' . $n['id'] . '">Marcar como completa</a>)</small></div>';
	echo '<div style="margin: 1px; padding: 5px;">' . clean($n['content'], true, true) . '</div>';
	echo '</div>';
}

?>

<h2>Adicionar novo item</h2>
<br />
<form method="post">
<textarea cols="40" rows="4" name="content"></textarea><br /><br />
<input type="submit" name="submit" value="Adicionar">
</form>

<?php

require_once "bottom.php";

?>