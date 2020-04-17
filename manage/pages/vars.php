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

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

if (isset($_POST['edit-no']))
{
	dbquery("UPDATE external_variables SET skey = '" . filter($_POST['key']) . "', sval = '" . filter($_POST['value'])	. "' WHERE skey = '" . filter($_POST['edit-no']) . "' LIMIT 1");
}

if (isset($_POST['newkey']))
{
	dbquery("INSERT INTO external_variables (skey,sval) VALUES ('" . filter($_POST['newkey']) . "','" . filter($_POST['newval']) . "')");
}

if (isset($_GET['doDel']))
{
	dbquery("DELETE FROM external_variables WHERE skey = '" . filter($_GET['doDel']) . "' LIMIT 1");
	fMessage('ok', 'Key removed.');
	header("Location: index.php?_cmd=vars");
	exit;
}

require_once "top.php";

echo '<h1>External variables</h1>';
echo '<p>Esta ferramenta pode ser usada para alterar a external variables.</p><br />';

echo '<a href="http://habborool.no-ip.biz/r59/external_variables.txt?" id="">Visualizar a external variables</a>';

echo '<table border="1" width="100%">';
echo '<thead>';
echo '<tr>';
echo '<td>Chave</td>';
echo '<td>Valor</td>';
echo '<td>Controle</td>';
echo '</tr>';

$get = dbquery("SELECT * FROM external_variables");

while ($text = mysql_fetch_assoc($get))
{
	echo '<tr><form method="post">';
	echo '<input type="hidden" name="edit-no" value="' . clean($text['skey']) . '">';
	echo '<td><input type="text" style="width: 100%; padding: 10px; font-size: 115%;" name="key" value="' . clean($text['skey']) . '"></td>';
	echo '<td><textarea style="width: 100%; height: 100%;" name="value">' . clean($text['sval']) . '</textarea></td>';
	echo '<td><center><input type="submit" value="Atualizar">&nbsp;<input type="button" value="Deletar" onclick="window.location = \'index.php?_cmd=vars&doDel=' . $text['skey'] . '\';"></center></td>';
	echo '</form></tr>';
}

echo '<tr><form method="post">';
echo '<td><input type="text" style="width: 100%; padding: 10px; font-size: 115%;" name="newkey"></td>';
echo '<td><textarea name="newval" style="width: 100%; height: 100%;"></textarea>';
echo '<td><center><input type="submit" value="Adicionar">';
echo '</form></tr>';

echo '</thead>';
echo '</table>';

require_once "bottom.php";

?>