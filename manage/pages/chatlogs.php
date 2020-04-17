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

require_once "../inc/class.rooms.php";

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_moderation'))
{
	exit;
}

$searchResults = null;

if (isset($_GET['timeSearch']))
{
	$_POST['searchQuery'] = $_GET['timeSearch'];
	$_POST['searchType'] = '4';
}

if (isset($_POST['searchQuery']))
{
	$query = filter($_POST['searchQuery']);
	$type = $_POST['searchType'];
	
	$q = "SELECT * FROM chatlogs WHERE ";
	
	switch ($type)
	{
		default:
		case '1':
		
			$q .= "user_name = '" . $query . "'";
			break;
			
		case '2':
		
			$q .= "message LIKE '%" . $query . "%'";
			break;
			
		case '3':
		
			$q .= "room_id = '" . $query . "'";
			break;
			
		case '4':
		
			$cutMin = intval($query) - 300;
			$cutMax = intval($query) + 300;
			
			$q .= "timestamp >= " . $cutMin . " AND timestamp <= " . $cutMax;
	}
	
	$searchResults = dbquery($q);
}

require_once "top.php";

?>			

<h1>Conversas</h1>

<br />

<p>
		Esta ferramenta monitora as conversas dos usuários. OBS: Ela não monitora o minimail e o Chat especial.
</p>

<br />

<p>
	<b>IMPORTANTE:</b> Você pode ver só uma quantia de conversas.<br />
	A cada 2 semanas essas conversas são deletadas do nosso sistema.
</p>

<?php

if (isset($searchResults))
{
	echo '<h2>Procurar resultados - Você procurou por "<span style="font-size: 125%;">' . clean($_POST['searchQuery']) . '</span>"</h2>';
	echo '<br /><p><a href="index.php?_cmd=chatlogs&doReset">Limpar busca</a></p><br />
	
	<table width="100%">
	<thead>
	<tr>
		<td>Data</td>
		<td>Hora</td>
		<td>Usuário</td>
		<td>Quarto</td>
		<td>Conversas</td>
		<td>Segundos atrás</td>
	</tr>
	<tbody>';
	
	while ($result = mysql_fetch_assoc($searchResults))
	{
		if (strlen($result['hour']) < 2)
		{
			$result['hour'] = '0' . $result['hour'];
		}
		
		if (strlen($result['minute']) < 2)
		{
			$result['minute'] = '0' . $result['minute'];
		}		
	
		echo '<tr>
		<td>' . $result['full_date'] . '</td>
		<td>' . $result['hour'] . ':' . $result['minute'] . '</td>
		<td><a href="#">' . clean($result['user_name']) . '</a> (' . $result['user_id'] . ')</td>
		<td><a href="#">' . clean(RoomManager::GetRoomVar($result['room_id'], 'caption')) . '</a> (' . $result['room_id'] . ')</td>
		<td>' . clean($result['message']) . '</td>
		<td>' . clean($result['timestamp']) . ' (<a href="index.php?_cmd=chatlogs&timeSearch=' . intval($result['timestamp']) . '">Procurar</a>)</td>
		</tr>';
	}
	
	echo '</tbody>
	</thead>
	</table>';
}
else
{
	echo '<h2>Buscar por conversas</h2>
	
	<br />
	
	<form method="post">
	
	Método:&nbsp;
	<select name="searchType">
	<option value="1">Por usuário</option>
	<option value="2">Por mensagem</option>
	<option value="3">Por quarto (SOMENTE ID)</option>
	<option value="4">Segundos atrás (MAX 600 seg.)</option>
	</select>
	
	<br /><br />
	
	Buscar (O usuário, a mensagem, o ID e a quantidade de segundos):&nbsp;
	<input type="text" name="searchQuery">
	
	<br /><br />
	
	<input type="submit" value="Buscar">
	
	</form>
	
	
	<h2>Atividade recente</h2>
	<table width="100%">
	<thead>
	<tr>
		<td>Data</td>
		<td>Hora</td>
		<td>Usuário</td>
		<td>Quarto</td>
		<td>Mensagem</td>
		<td>Segundos atrás</td>
	</tr>
	<tbody>';
	
	$getRecent = dbquery("SELECT * FROM chatlogs ORDER BY id DESC LIMIT 30");
	
	while ($recent = mysql_fetch_assoc($getRecent))
	{
		if (strlen($recent['hour']) < 2)
		{
			$recent['hour'] = '0' . $recent['hour'];
		}
		
		if (strlen($recent['minute']) < 2)
		{
			$recent['minute'] = '0' . $recent['minute'];
		}		
	
		echo '<tr>
		<td>' . $recent['full_date'] . '</td>
		<td>' . $recent['hour'] . ':' . $recent['minute'] . '</td>
		<td><a href="#">' . clean($recent['user_name']) . '</a> (' . $recent['user_id'] . ')</td>
		<td><a href="#">' . clean(RoomManager::GetRoomVar($recent['room_id'], 'caption')) . '</a> (' . $recent['room_id'] . ')</td>
		<td>' . clean($recent['message']) . '</td>
		<td>' . clean($recent['timestamp']) . ' (<a href="index.php?_cmd=chatlogs&timeSearch=' . intval($recent['timestamp']) . '">Procurar</a>)</td>
		</tr>';
	}
	
	echo '</tbody>
	</thead>
	</table>';
}


require_once "bottom.php";

?>