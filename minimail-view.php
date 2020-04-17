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

require_once "global.php";

if (!LOGGED_IN)
{
	exit;
}

$messageId = 0;
$messageData = null;
$senderData = null;

if (isset($_GET['messageId']) && is_numeric($_GET['messageId']))
{
	$messageId = intval($_GET['messageId']);
}

if ($messageId > 0)
{
	$getMessage = dbquery("SELECT * FROM site_minimail WHERE id = '" . $messageId . "' AND receiver_id = '" . USER_ID . "' LIMIT 1");
	
	if (mysql_num_rows($getMessage) == 1)
	{
		$messageData = mysql_fetch_assoc($getMessage);
		$getSender = dbquery("SELECT * FROM users WHERE id = '" . $messageData['sender_id'] . "' LIMIT 1");
		
		if (mysql_num_rows($getSender) == 1)
		{
			$senderData = mysql_fetch_assoc($getSender);
		}
	}
}

if ($messageId == 0 || $messageData == null || $senderData == null)
{
	die("<div style='padding: 10px;'><b>Oops!</b><br />A mensagem n�o pode ser entregue. Tente novamente. Se os problemas persistirem um m�dico dever� ser consultado.</div>");
}

$tpl->Init();

$message = new Template('minimail-message');
$message->SetParam('to', USER_NAME);
$message->SetParam('from', clean($senderData['username']));
$message->SetParam('message_id', $messageData['id']);
$message->SetParam('subject', clean($messageData['subject']));
$message->SetParam('body-text', nl2br(clean($messageData['body'])));
$message->SetParam('trashed', ($messageData['folder'] == "trash") ? true : false);
$message->SetParam('sent', ($messageData['folder'] == "sent") ? true : false);

if ($messageData['is_read'] == "0")
{
	dbquery("UPDATE site_minimail SET is_read = '1' WHERE id = '" . $messageData['id'] . "' LIMIT 1");
}

$tpl->AddTemplate($message);
$tpl->Output();

?>