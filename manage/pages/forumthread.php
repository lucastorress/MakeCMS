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

if (!HK_LOGGED_IN)
{
	exit;
}

$t = null;

if (isset($_GET['i']) && is_numeric($_GET['i']))
{
	$i = intval($_GET['i']);
	$s = dbquery("SELECT * FROM moderation_forum_threads WHERE id = '" . $i . "' LIMIT 1");
	
	if (mysql_num_rows($s) >= 1)
	{
		$t = mysql_fetch_assoc($s);
	}
}

if ($t == null)
{
	die("Thread not found");
}

if ($t['locked'] == "0" && isset($_POST['msg']))
{	
	$msg = filter($_POST['msg']);
	
	if (strlen($msg) <= 12)
	{
		die("Mensagem muito curta. Crie algo criativo !");
	}
	
	dbquery("INSERT INTO moderation_forum_replies (thread_id,poster,date,message) VALUES ('" . $t['id'] . "','" . HK_USER_NAME . "','" . date('j F Y h:i A') . "','" . $msg . "')");
	
	if ($t['timestamp'] < 99999999999)
	{
		dbquery("UPDATE moderation_forum_threads SET timestamp = '" . time() . "' WHERE id = '" . $t['id'] . "' LIMIT 1");
	}
	
	header("Location: index.php?_cmd=forumthread&i=" . $t['id']);
	exit;
}

if (isset($_POST['opt']))
{
	$opt = $_POST['opt'];
	
	switch ($opt)
	{
		case 'lock':
		
			$newState = 1;
			$l = 'fechado';
			
			if ($t['locked'] == "1")
			{
				$newState = 0;
				$l = 'aberto';
			}
			
			fMessage('ok', 'T�pico ' . $l . '.');
			
			dbquery("UPDATE moderation_forum_threads SET locked = '" . $newState . "' WHERE id = '" . $t['id'] . "' LIMIT 1");
			break;
	
		case 'stick':
		
			fMessage('ok', 'T�pico fixo.');
		
			dbquery("UPDATE moderation_forum_threads SET timestamp = '99999999999' WHERE id = '" . $t['id'] . "' LIMIT 1");
			break;
	
		case 'bump':
		
			fMessage('ok', 'T�pico atualizado.');
		
			dbquery("UPDATE moderation_forum_threads SET timestamp = '" . time() . "' WHERE id = '" . $t['id'] . "' LIMIT 1");
			break;
	
		case 'del';
		
			fMessage('ok', 'Deletar t�pico.');
		
			dbquery("DELETE FROM moderation_forum_threads WHERE id = '" . $t['id'] . "' LIMIT 1");
			dbquery("DELETE FROM moderation_forum_replies WHERE thread_id = '" . $t['id'] . "'");
			break;
	}
	
	header("Location: index.php?_cmd=forum");
	exit;
}

require_once "top.php";

?>	

<h1>
	<?php if ($t['locked'] >= 1) { echo '<img src="images/locked.gif" alt="Fechado" title="T�pico fechado" style="vertical-align: middle;">'; } ?>
	<?php if ($t['timestamp'] >= 99999999999) { echo '<img src="images/sticky.gif" alt="Fixo" title="T�pico fixo" style="vertical-align: middle;">'; } ?>
	F�rum de discu��o - "<?php echo clean($t['subject']); ?>"<br />
	<small style="font-weight: normal; font-size: 80%;"><?php echo $t['poster']; ?> no <?php echo $t['date']; ?> (<a href="index.php?_cmd=forum">Retornar para o f�rum de discu��o</a>)</small>
</h1>

<?php if ($users->hasFuse(HK_USER_ID, 'fuse_admin')) { ?>

<br />
<div id="toolbox" style="font-weight: normal; border: 1px dotted #000; margin: 0px; padding: 5px;">
<form method="post">

<b>Op��es da administra��o:</b>

&nbsp;

<select name="opt">
	<?php if ($t['timestamp'] < 99999999999) { ?><option value="stick">T�pico Fixo</option><?php } ?>
	<option value="bump"><?php if ($t['timestamp'] >= 99999999999) { echo 'Retirar "fixo"'; } else { echo 'Atualizar t�pico'; } ?></option>	
	<option value="lock"><?php if ($t['locked'] == "1") { echo 'Desbloquear'; } else { echo 'Bloquear'; } ?></option>
	<option value="del">Deletar t�pico</option>
</select>

&nbsp;

<input type="submit" value="Pronto">

</form>
</div>
<br />

<?php } ?>

<br />

<p style="padding: 5px;">
	<?php echo nl2br(clean($t['message'])); ?>
</p>

<br />

<?php

$getReplies = dbquery("SELECT * FROM moderation_forum_replies WHERE thread_id = '" . $t['id'] . "'");

echo '<br />';

if (mysql_num_rows($getReplies) >= 1)
{
	echo '<b style="font-size: 125%;">Respostas</b>';
	
	while ($r = mysql_fetch_assoc($getReplies))
	{
		echo '<h2 style="font-weight: normal; padding: 8px;">';
		echo '<p><B><small>' . $r['poster'] . ' respondeu:</small></B></p><br />';
		echo '<p style="padding: 5px;">' . nl2br(clean($r['message'])) . '</p><br />';
		echo '<p><small>' . $r['date'] . '</p></small>';
		echo '</h2>';
		echo '<br />';		
	}
}
else if ($t['locked'] == "0")
{
	echo '<i>Este t�pico n�o tem nenhuma resposta.</i>';
}

if ($t['locked'] == "0") {
?>

<h2 id="cn-link">
	<a href="#" onclick="t('cn-link'); t('cn-form'); return false">Responder</a>
</h2>

<h2 id="cn-form" style="display: none;">
<form method="post">

Mensagem :<br />
<textarea name="msg" rows="5" cols="50"></textarea><br />
<br />
<input type="submit" value="Enviar">
<input type="button" value="Cancelar" onclick="t('cn-link'); t('cn-form');">
</form>
</h2>

<?php
}

require_once "bottom.php";

?>