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

if (isset($_GET['new']))
{
	dbquery("INSERT INTO moderation_presets (type,enabled,message) VALUES ('message','0','Newly generated preset - please update')");
	
	fMessage('ok', 'Nova configura��o adicionada.');
	
	header("Location: index.php?_cmd=presets");
	exit;
}

if (isset($_GET['delete']) && is_numeric($_GET['delete']))
{
	dbquery("DELETE FROM moderation_presets WHERE id = '" . intval($_GET['delete']) . "' LIMIT 1");
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Configura��o deletada.');
	}
	
	header("Location: index.php?_cmd=presets");
	exit;	
}

if (isset($_POST['preset-save']) && is_numeric($_POST['preset-save']))
{
	$id = intval($_POST['preset-save']);
	$type = filter($_POST['type']);
	$enabled = filter($_POST['enabled']);
	$message = filter($_POST['message']);
	
	dbquery("UPDATE moderation_presets SET type = '" . $type . "', enabled = '" . $enabled . "', message = '" . $message . "' WHERE id = '" . $id . "' LIMIT 1");
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Configura��o atualizada.');
	}
}

require_once "top.php";

?>			

<h1>Configura��es</h1>

<h2>MOD TOOL ! Voc� pode configurar aqui, todos os comandos do MOD TOOLS do Hotel !</h2>
<br />

<table width="100%" border="1" >
<thead>
	<td>ID</td>
	<td>Tipo</td>
	<td>Ativado</td>
	<td>Mensagem</td>
	<td>Op��o</td>
</thead>
<tbody>
<?php

$get = dbquery("SELECT * FROM moderation_presets ORDER BY id DESC");

while ($p = mysql_fetch_assoc($get))
{
	echo '<tr>';
	echo '<form method="post">';
	echo '<input type="hidden" name="preset-save" value="' . $p['id'] . '">';
	echo '<td>#' . $p['id'] . '</td>';
	echo '<td><select name="type"><option value="message">Mensagem para o usu�rio (amig�vel)</option><option value="roommessage"';
	
	if ($p['type'] == "roommessage")
	{
		echo ' selected';
	}
	
	echo '>Alertar o quarto</option></select></td>';
	echo '<td><select name="enabled"><option value="1">Ativado</option><option value="0"';
	
	if ($p['enabled'] == "0")
	{
		echo ' selected';
	}
	
	echo '>Desativado</option></select></td>';
	echo '<td><textarea name="message" cols="50" rows="5">' . clean($p['message']) . '</textarea></p></td>';
	echo '<td><input type="submit" value="Salvar">&nbsp;<input type="button" onclick="document.location = \'index.php?_cmd=presets&delete=' . $p['id'] . '\';" value="Deletar"></td>';
	echo '</form>';
	echo '</tr>';
}

?>
</tbody>
</table>

<br />
<br />

<center>

	<a href="index.php?_cmd=presets&new">
		<b>Adicionar novo comando</b>
	</a>
	
	<br /><br />
	
	<i style="color: darkred;">
		NOTA: Ap�s voc� adicionar esse comando aqui, ser� necess�rio reiniciar o hotel para ser visualizado.
	</i>
</center>



<?php

require_once "bottom.php";

?>