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

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_moderation'))
{
	exit;
}

function formatType($t)
{
	switch (intval($t))
	{
		case 101:
		
			return 'Sexo';
			
		case 102:
		
			return 'Link de outros habbos';
			
		case 103:
		
			return 'Bloqueando passagens';
			
		case 104:
		
			return 'Abuso';
	
		case 105:
		
			return 'Racismo';
			
		case 106:
		
			return 'Outro';
	
		default:
		
			return $t;
	}
}

function formatSent($stamp)
{
	$stamp = time() - $stamp;

	$x = '';

	if ($stamp >= 604800)
	{
		$x = ceil($stamp / 604800) . 'wks';
	}
	else if ($stamp > 86400)
	{
		$x = ceil($stamp / 86400) . 'day';
	}
	else if ($stamp >= 3600)
	{
		$x = ceil($stamp / 3600) . 'hr';
	}
	else if ($stamp >= 120)
	{
		$x  = ceil($stamp / 60) . 'min';
	}
	else
	{
		$x = $stamp . ' s';
	}
	
	$x .= ' ago';
	return $x;
}

require_once "top.php";

?>			

<h1>Pedidos de ajuda</h1>

<p>
	Essa p�gina, voc� pode visualizar todos os pedidos de ajuda.
</p>

<br />

<p>
	<b>Aqui voc� pode visualizar todos os pedidos de ajuda. Mais que elas possam ser efetuadas, usem o MOD TOOLS que se encontra no Hotel.</b>
</p>

<br />

<p>
	<small>** Este painel tem como a fun��o de mostrar os pedidos de ajuda enquanto nenhum moderador estava online.</small>
</p>

<br />

<table width="100%" border="1">
<thead>
	<td>ID</td>
	<td>Tipo</td>
	<td>Status</td>
	<td>Usu�rio</td>
	<td>Usu�rio reportado</td>
	<td>Moderador</td>
	<td>Mensagem</td>
	<td>Quarto</td>
	<td>Enviado</td>
	<td>Conversas</td>
</thead>
<?php

$get = dbquery("SELECT * FROM moderation_tickets ORDER BY id DESC");

while ($user = mysql_fetch_assoc($get))
{
	echo '<tr>';
	echo '<td>' . clean($user['id']) . '</td>';
	echo '<td>' . formatType($user['type']) . '</td>';
	echo '<td>' . clean($user['status']) . '</td>';
	echo '<td>' . $users->formatUsername($user['sender_id']) . '</td>';
	echo '<td>';
	
	if ($user['reported_id'] >= 1)
	{
		echo $users->formatUsername($user['reported_id']);
	}
	else
	{
		echo '-';
	}
	
	echo '</td>';
	echo '<td>';
	
	if ($user['moderator_id'] >= 1)
	{
		echo $users->formatUsername($user['moderator_id']);
	}
	else
	{
		echo '-';
	}
	
	echo '</td>';	
	echo '<td>' . clean($user['message']) . '</td>';
	echo '<td>' . clean($user['room_name']) . '</td>';
	echo '<td>' . formatSent($user['timestamp']) . '</td>';
	echo '<td><a href="index.php?_cmd=chatlogs&timeSearch=' . $user['timestamp'] . '">Ver</a></td>';
	echo '</tr>';
}

?>
</table>

<?php

require_once "bottom.php";

?>