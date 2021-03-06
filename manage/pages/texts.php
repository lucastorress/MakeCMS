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
	dbquery("UPDATE external_texts SET skey = '" . filter($_POST['key']) . "', sval = '" . filter($_POST['value'])	. "' WHERE skey = '" . filter($_POST['edit-no']) . "' LIMIT 1");
}

if (isset($_POST['newkey']))
{
	dbquery("INSERT INTO external_texts (skey,sval) VALUES ('" . filter($_POST['newkey']) . "','" . filter($_POST['newval']) . "')");
}

if (isset($_GET['doDel']))
{
	dbquery("DELETE FROM external_texts WHERE skey = '" . filter($_GET['doDel']) . "' LIMIT 1");
	fMessage('ok', 'Chave removida.');
	header("Location: index.php?_cmd=texts");
	exit;
}

require_once "top.php";

echo '<h1>External texts</h1>';
echo '<p>Esta ferramenta, voc� pode mudar o texto da external texts.</p><br />';

echo '<a href="http://habborool.no-ip.biz/gamedata/external_flash_texts.txt?" id="">Visualizar a external texts</a>';

echo '<table border="1" width="100%">';
echo '<thead>';
echo '<tr>';
echo '<td>Chave</td>';
echo '<td>Valor</td>';
echo '<td>Controles</td>';
echo '</tr>';

$get = dbquery("SELECT * FROM external_texts");

while ($text = mysql_fetch_assoc($get))
{
	echo '<tr><form method="post">';
	echo '<input type="hidden" name="edit-no" value="' . clean($text['skey']) . '">';
	echo '<td><input type="text" style="width: 100%; padding: 10px; font-size: 115%;" name="key" value="' . clean($text['skey']) . '"></td>';
	echo '<td><textarea style="width: 100%; height: 100%;" name="value">' . clean($text['sval']) . '</textarea></td>';
	echo '<td><center><input type="submit" value="Update">&nbsp;<input type="button" value="Deletar" onclick="window.location = \'index.php?_cmd=texts&doDel=' . $text['skey'] . '\';"></center></td>';
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