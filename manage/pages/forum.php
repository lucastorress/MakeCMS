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

if (isset($_POST['msg']))
{
	$subject = $_POST['subj'];
	$body = $_POST['msg'];
	
	if (strlen($subject) < 1)
	{
		$subject = 'Sem sujeito';
	}
	
	if (strlen($body) < 20)
	{
		die("Mensagem muito curta. Digite algo sério !");
	}
	
	dbquery("INSERT INTO moderation_forum_threads (subject,message,poster,date,timestamp) VALUES ('" . filter($subject) . "','" . filter($body) . "','" . HK_USER_NAME . "','" . date('j F Y h:i A') . "','" . time() . "')");
	
	fMessage('ok', 'Tópico criado');
	
	header("Location: index.php?_cmd=forum");
	exit;
}

require_once "top.php";

?>			

<h1>Fórum de discução</h1>

<p>
	Use o fórum de discução para nos ajudar reportando bugs, erros, entre outros. Aqui você pode debater e interagir com outros usuários da nossa equipe. Basta criar um tópico que a nossa gerência irá responder.
</p>

<?php

$getTopics = dbquery("SELECT * FROM moderation_forum_threads ORDER BY timestamp DESC");

if (mysql_num_rows($getTopics) >= 1)
{
	while ($topic = mysql_fetch_assoc($getTopics))
	{
		echo '<h2 style="font-weight: normal;"><a href="index.php?_cmd=forumthread&i=' . $topic['id'] . '">';
		echo '<b style="font-size: 130%;">';
		
		if ($topic['locked'] >= 1)
		{
			echo '<img src="images/locked.gif" alt="Locked" title="Tópico fechado" style="vertical-align: middle;">&nbsp;';
		}		
		
		if ($topic['timestamp'] >= 99999999999)
		{
			echo '<img src="images/sticky.gif" alt="Sticky" title="Tópico fixo" style="vertical-align: middle;">&nbsp;';
		}
		
		echo clean($topic['subject']) . '</b>&nbsp;';
		
		$rCount = mysql_result(dbquery("SELECT COUNT(*) FROM moderation_forum_replies WHERE thread_id = '" . $topic['id'] . "'"), 0);
		
		if ($topic['locked'] == "0" || $rCount > 0)
		{
			echo '(' . $rCount . ' replies)';
		}
		
		echo '<br />';
		
		/*echo '<p><small>' . substr($topic['message'], 0, 120);
		
		if (strlen($topic['message']) > 120)
		{
			echo '...';
		}
		
		echo '</small></p><br />';*/
		
		echo 'Postado no dia ' . $topic['date'] . ' por <b>' . $topic['poster'] . '</b>';
		echo '</a></h2>';
	}
}
else
{
	echo '<br /><center><b><i>Até agora não foi postado nenhum tópico.</b></i></center><br />';
}

?>

<h2 id="cn-link">
	<a href="#" onclick="t('cn-link'); t('cn-form'); return false">Criar novo tópico</a>
</h2>

<h2 id="cn-form" style="display: none;">
<form method="post">

Sujeito:<br />
<input type="text" name="subj" size="35" maxlength="120"><br />
<br />
Mensagem:<br />
<textarea name="msg" cols="50" rows="5"></textarea><br />
<br />
<input type="submit" value="Criar">
<input type="button" value="Cancelar" onclick="t('cn-link'); t('cn-form');">
</form>
</h2>

<?php

require_once "bottom.php";

?>