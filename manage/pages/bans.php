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

require_once "../inc/class.rooms.php";

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_moderation'))
{
	exit;
}

if (isset($_GET['doDenyAppeal']) && is_numeric($_GET['doDenyAppeal']))
{
	dbquery("UPDATE bans SET appeal_state = '2' WHERE id = '" . intval($_GET['doDenyAppeal']) . "'" . (($users->HasFuse(USER_ID, 'fuse_admin')) ? "" : " AND added_by = '" . HK_USER_NAME . "'") . " LIMIT 1");
	
	if (mysql_affected_rows() >= 1)
	{
		dbquery("DELETE FROM bans_appeals WHERE ban_id = '" . intval($_GET['doDenyAppeal']) . "' LIMIT 1");
		fMessage('ok', 'Banimento entregue.');
		
		header("Location: index.php?_cmd=bans");
		exit;		
	}
}

if (isset($_GET['unban']) && is_numeric($_GET['unban']))
{
	dbquery("DELETE FROM bans WHERE id = '" . intval($_GET['unban']) . "'" . (($users->HasFuse(USER_ID, 'fuse_admin')) ? "" : " AND added_by = '" . HK_USER_NAME . "'") . " LIMIT 1");
	
	if (mysql_affected_rows() >= 1)
	{
		dbquery("DELETE FROM bans_appeals WHERE ban_id = '" . intval($_GET['unban']) . "' LIMIT 1");
		fMessage('ok', 'Banimento removido.');
		
		$core->Mus('reloadbans');
		
		header("Location: index.php?_cmd=bans");
		exit;
	}
}

if (isset($_POST['bantype']))
{
	$bantype = filter($_POST['bantype']);
	$value = filter($_POST['value']);
	$reason = filter($_POST['reason']);
	$length = filter($_POST['length']);
	$noAppeal = '';
	
	if (isset($_POST['no-appeal']))
	{
		$noAppeal = filter($_POST['no-appeal']);
	}
	
	if ($bantype != "ip" && $bantype != "user")
	{
		$bantype = "user";
	}
	
	if (strlen($value) <= 0 || strlen($reason) <= 0 || !is_numeric($length) || intval($length) < 600)
	{
		fMessage('error', 'N�o deixe os espa�os em branco !');
		header("Location: index.php?_cmd=bans");
		exit;
	}
	
	// $type, $value, $reason, $expireTime, $addedBy
	uberCore::AddBan($bantype, $value, $reason, time() + $length, HK_USER_NAME, (($noAppeal == "checked") ? true : false));
	$core->Mus('reloadbans');
}

require_once "top.php";

?>			

<h1>Administrar banimentos</h1>

<br />

<p>
	Esta ferramenta permite que voc� edite os banimento e tamb�m que possa banir algum usu�rio.
</p>

<br />

<h2>Banimentos pendentes</h2>

<br />

<p>
	Somente administradores tem acesso a lista de banimento.
</p>

<br />

<table width="100%" border="1">
<thead>
<tr>
	<td>Detalhes do banimento</td>
	<td>Endere�o de IP</td>
	<td>Data Submetida</td>
	<td>Responder e-mail</td>
	<td>Plea</td>
	<td>Rever</td>
</tr>
</thead>
<tbody>
<?php

$getMyBans = dbquery("SELECT id,bantype,value,expire,added_date,appeal_state FROM bans WHERE appeal_state = '1'" . (($users->HasFuse(USER_ID, 'fuse_admin')) ? "" : " AND added_by = '" . HK_USER_NAME . "'"));

while ($ban = mysql_fetch_assoc($getMyBans))
{
	$findAppeal = dbquery("SELECT * FROM bans_appeals WHERE ban_id = '" . $ban['id'] . "' LIMIT 1");
	
	if (mysql_num_rows($findAppeal) == 1)
	{
		$data = mysql_fetch_assoc($findAppeal);
		
		if ($data['plea'] == '')
		{
			continue;
		}
	
		echo '<tr>
		<td>' . strtoupper($ban['bantype']) . ' Banimento : <b>' . clean($ban['value']) . '</b><br />
		Foi feito em <u>' . $ban['added_date'] . '</u>,<br />e expira no dia <u>' . date('d F, Y', $ban['expire']) . '</u>.</td>
		<td>' . $data['send_ip'] . '</td>
		<td>' . $data['send_date'] . '</td>
		<td>' . clean($data['email']) . '</td>
		<td style="background-color: #CEE3F6; text-align: center; font-size: 90%;">' . nl2br(clean($data['plea'])) . '</td>
		<td><input type="button" style="color: darkgreen;" onclick="document.location = \'index.php?_cmd=bans&unban=' . $data['ban_id'] . '\';" value="Aceitar un-ban">&nbsp;<input style="color: darkred;" type="button" onclick="document.location = \'index.php?_cmd=bans&doDenyAppeal=' . $ban['id'] . '\';" value="Proibido"></td>
		</tr>';
	}
}

?>
</tbody>
</table>

<br />
<h2>Adicionar novo banimento</h2>
<br />
<form method="post">

Ban type:<br />
<select name="bantype" onclick="onchange="if (this.value == 'ip') { document.getElementById('ban-value-heading').innerHTML = 'Endere�o de IP'; } else { document.getElementById('ban-value-heading').innerHTML = 'Usu�rio'; }" onkeyup="onchange="if (this.value == 'ip') { document.getElementById('ban-value-heading').innerHTML = 'Endere�o de IP'; } else { document.getElementById('ban-value-heading').innerHTML = 'Usu�rio'; }" onchange="if (this.value == 'ip') { document.getElementById('ban-value-heading').innerHTML = 'Endere�o de IP'; } else { document.getElementById('ban-value-heading').innerHTML = 'Usu�rio'; }">
<option value="ip">IP Banido</option>
<option value="user">Usu�rio banido</option>
</select><br />
<br />

<span id="ban-value-heading">Endere�o de IP</span>:<Br />
<input type="text" name="value"><br />
<br />

Motivo:<br />
<input type="text" name="reason"><br />
<br />

<script type="text/javascript">
function banPreset(val)
{
	document.getElementById('banlength').value = val;
}
</script>

Length (in seconds!):<br />
<input type="text" name="length" id="banlength"> secs<br />
<small>(Presets: <a href="#" onclick="banPreset(3600);">1hr</a> <a href="#" onclick="banPreset(10800);">3hr</a> <a href="#" onclick="banPreset(43200);">12hr</a> <a href="#" onclick="banPreset(86400);">1dia</a> <a href="#" onclick="banPreset(259200);">3day</a> <a href="#" onclick="banPreset(604800);">1sm</a> <a href="#" onclick="banPreset(1209600);">2wk</a> <a href="#" onclick="banPreset(2592000);">1m�s</a> <a href="#" onclick="banPreset(7776000);">3mo</a> <a href="#" onclick="banPreset(1314000);">1an</a> <a href="#" onclick="banPreset(2628000);">2yr</a> <a href="#" onclick="banPreset(360000000);">Perm</a>)</small><br />
<br />

<input type="checkbox" name="no-appeal" value="checked"> OK<br />
<br />

<input type="submit" value="Banir !">

</form>

<br />
<h2>Lista de banimentos</h2>

<br />

<table width="100%" border="1">
<thead>
<tr>
	<td>Ban ID</td>
	<td>Data</td>
	<td>Motivo</td>
	<td>Expira</td>
	<td>Add</td>
	<td>Status</td>
	<td>Op��o</td>
</tr>
</thead>
<tbody>
<?php

$getBans = dbquery("SELECT * FROM bans ORDER BY expire DESC");

while ($ban = mysql_fetch_assoc($getBans))
{
	echo '<tr>
	<td>' . $ban['id'] . '</td>
	<td>' . strtoupper($ban['bantype']) . ' Ban: <b>' . clean($ban['value']) . '</b></td>
	<td style="text-align: center; font-size: 90%;">' . clean($ban['reason'], true, true) . '</td>
	' . (($ban['expire'] <= time()) ? '<td style="text-align: center; background-color: #F6CECE; color: #B40404;">Expired ' . date('d F, Y', $ban['expire']) . '</td>' : '<td>Expires ' . date('d F, Y', $ban['expire']) . '</td>') . '
	<td>On ' . $ban['added_date'] . ' by ' . clean($ban['added_by']) . '</td>
	<td style="text-align: center;">';
	
	if ($ban['appeal_state'] == "0")
	{
		echo 'N�o ser� permitido apelo !';
	}
	else if ($ban['appeal_state'] == "1")
	{
		if (mysql_num_rows(dbquery("SELECT null FROM bans_appeals WHERE ban_id = '" . $ban['id'] . "' AND plea != '' LIMIT 1")) > 0)
		{
			echo '<b style="color: blue;">Usu�rio foi banido sem apelo e est� � espera de um milagre !</b>';
		}
		else
		{
			echo 'Usu�rio banido sem apelo';
		}
	}
	else if ($ban['appeal_state'] == "2")
	{
		echo '<b style="color: red;">Apelo visto e rejeitado</b>';
	}
	
	echo '</td>
	<td>';
	
	if (strtolower($ban['added_by']) == strtolower(HK_USER_NAME) || $users->HasFuse(USER_ID, 'fuse_admin'))
	{
		echo '<input type="button" onclick="document.location = \'index.php?_cmd=bans&unban=' . $ban['id'] . '\';" value="' . (($ban['expire'] <= time()) ? 'Remover' : 'Desbanir') . '">';
	}
	
	echo '</td></tr>';
}

?>
</body>
</table>

<?php

require_once "bottom.php";

?>