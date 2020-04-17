<?php
/*=======================================================================
| WareCMS - Sistema avançado de Administração de CMS
| #######################################################################
| Copyright (c) 2010, Lucas Reis & Dcr-Host
| #######################################################################
| Este programa é um FreeSoftware aonde você pode editar os conteúdos
| com os direitos autorais do editor.
| #######################################################################
| Este programa foi editado traduzido por Lucas Reis, créditos totais
| para Meth0d, autor original do programa.
\======================================================================*/

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

$data = null;
$u = 0;

if (isset($_GET['u']) && is_numeric($_GET['u']))
{
	$u = intval($_GET['u']);
	$getData = dbquery("SELECT id,username FROM users WHERE id = '" . $u . "' LIMIT 1");
	
	if (mysql_num_rows($getData) > 0)
	{
		$data = mysql_fetch_assoc($getData);
	}
}
else if (isset($_POST['usrsearch']))
{
	$usrSearch = filter($_POST['usrsearch']);
	$getData = dbquery("SELECT id,username FROM users WHERE username = '" . $usrSearch . "' LIMIT 1");
	
	if (mysql_num_rows($getData) > 0)
	{
		$data = mysql_fetch_assoc($getData);
		
		header("Location: index.php?_cmd=badges&u=" . $data['id']);
		exit;
	}	
	else
	{
		fMessage('error', 'Usuário não encontrado !');
	}
}

require_once "top.php";			

echo '<h1>Administrar emblemas dos usuários</h1>';

if ($data == null)
{
	echo '<p><i>Usuário não definido ou errado.</i> Para editar o emblema de um usuário, procure abaixo.</p>';
	echo '<Br />';
	echo '<p><form method="post">';
	echo 'Por UID: <input id="uidval" type="text" size="5" name="uid">&nbsp; <input type="button" value="Ok" onclick="window.location = \'index.php?_cmd=badges&u=\' + document.getElementById(\'uidval\').value;"><br />';
	echo 'Por nome: <input type="text" name="usrsearch" value="">&nbsp; <input type="submit" value="Ok">';
	echo '</form></p>';
}
else
{
	if (isset($_GET['take']))
	{
		dbquery("DELETE FROM user_badges WHERE user_id = '" . $data['id'] . "' AND badge_id = '" . filter($_GET['take']) . "'");
		
		if (mysql_affected_rows() >= 1)
		{
			echo '<b>Pegar emblema ' . $_GET['take'] . ' from ' . $data['username'] . '.</b>';
		}
	}	
	
	if (isset($_POST['newbadge']))
	{
		dbquery("INSERT INTO user_badges (user_id,badge_id,badge_slot) VALUES ('" . $data['id'] . "','" . filter($_POST['newbadge']) . "','0')");
		echo '<b>Emblema entregue !</b>';
	}

	echo '<h2>Editando emblemas: ' . $data['username'] . ' (<a href="index.php?_cmd=badges">Voltar para a busca do usuário</a>)</h2>';
	$getBadges = dbquery("SELECT badge_id,badge_slot FROM user_badges WHERE user_id = '" . $data['id'] . "'");
	
	echo '<Br /><table border="1">
	<thead>
	<tr>
		<td>Imagem</td>
		<td>Código do emblema</td>
		<td>Status</td>
		<td>Definição</td>
		<td>Controles</td>
	</tr>
	</thead>';
	
	while ($b = mysql_fetch_assoc($getBadges))
	{
		echo '<tr>';
		echo '<td><img src="http://habborool.no-ip.biz/r59/c_images/badges/' . $b['badge_id'] . '.gif"></td>';
		echo '<td><center>' . $b['badge_id'] . '</center></td>';
		echo '<td><center>';
		
		if ($b['badge_slot'] == 0)
		{
			echo 'Não equipado';
		}
		else
		{
			echo 'Equipado no Slot ' . $b['badge_slot'];
		}
		
		echo '</center></td>';
		echo '<td><a href="index.php?_cmd=badgedefs">';
		
		$tryGet1 = dbquery("SELECT sval FROM external_texts WHERE skey = 'badge_name_" . $b['badge_id'] . "'");
		$tryGet2 = dbquery("SELECT sval FROM external_texts WHERE skey = 'badge_desc_" . $b['badge_id'] . "'");
		
		if (mysql_num_rows($tryGet1) > 0)
		{
			echo '<b>' . mysql_result($tryGet1, 0) . '</b><br />';
		}
		else
		{
			echo '<b><i>(Nada definido)</i></b><br />';
		}
		
		if (mysql_num_rows($tryGet2) > 0)
		{
			echo mysql_result($tryGet2, 0);
		}
		else
		{
			echo '<i>(Nenhuma descrição definida)</i><br />';
		}		
		
		echo '</a></td>';
		echo '<td><center><input type="button" onclick="window.location = \'index.php?_cmd=badges&u=' . $u . '&take=' . $b['badge_id'] . '\';" value="Tomar"></center></td>';
		echo '</tr>';
	}
	
	echo '<tr><form method="post">
	<td><center>?</center></td>
	<td><input type="text" name="newbadge" value="" style="padding: 5px; font-size: 130%; text-align: center;"></td>
	<td><center>(Novo emblema)</center></td>
	<td>&nbsp;</td>
	<td><center><input type="submit" value="Entregar" onclick=""></center></td>
	</form></tr>';
}

require_once "bottom.php";

?>