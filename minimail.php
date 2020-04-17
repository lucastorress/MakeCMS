<?php
/*=======================================================================
| MakeCMS - Sistema avançado de Administração de CMS
| #######################################################################
| Copyright (c) 2010, Lucas Torres and Meth0d
| #######################################################################
| Este programa é um Free Software aonde você pode editar os conteúdos
| com os direitos autorais do editor.
| #######################################################################
| Contato:
|         lucastorres.ce@gmail.com / sonhador_br@live.com
\======================================================================*/

require_once "global.php";

if (!LOGGED_IN)
{
	exit;
}

$cmd = '';

if (isset($_GET['cmd']))
{
	$cmd = $_GET['cmd'];
}

switch (strtolower($cmd))
{
	case 'confirmreport':
	
		echo 'Não foi possível reportar essa mensagem. Peça ajuda no hotel.';
		break;

	case 'sendmessage':
	
		$replyData = null;
	
		if (isset($_POST['messageId']))
		{
			$messageId = intval($_POST['messageId']);
			$getMessage = dbquery("SELECT * FROM site_minimail WHERE folder = 'inbox' AND id = '" . $messageId . "' AND receiver_id = '" . USER_ID . "' LIMIT 1");
			
			if (mysql_num_rows($getMessage) == 1)
			{
				$replyData = mysql_fetch_assoc($getMessage);
			}
		}
	
		$recipientIds = Array();
		$subject = '';
		$body = '';
		
		if ($replyData != null)
		{
			$subject = 'RE: ' . filter($replyData['subject']);
			$recipientIds[] = $replyData['sender_id'];
		}
		else
		{
			if (isset($_POST['recipientIds']))
			{
				$recipientIds = explode(',', $_POST['recipientIds']);
			}
			
			if (isset($_POST['subject']))
			{
				$subject = filter($_POST['subject']);
			}
		}
		
		if (isset($_POST['body']))
		{
			$body = nl2br(filter($_POST['body']));
		}
		
		if (strlen($subject) < 1 || strlen($subject) > 120 || strlen($body) > 4096)
		{
			die("A mensagem não pode ser entregue. Não há destinatário ou o corpo da mensagem está muito grande.");
		}		
		
		foreach ($recipientIds as $r)
		{
			if (mysql_num_rows(dbquery("SELECT null FROM users WHERE id = '" . intval($r) . "' LIMIT 1")) == 1
			&& mysql_num_rows(dbquery("SELECT null FROM messenger_friendships WHERE user_one_id = '" . intval($r) . "' AND user_two_id = '" . USER_ID . "' LIMIT 1")) == 1)
			{
				dbquery("INSERT INTO site_minimail (sender_id,receiver_id,folder,is_read,subject,date,isodate,timestamp,body) VALUES ('" . USER_ID . "','" . $r . "','inbox','0','" . $subject . "','" . date('d-M-Y H:i:s') . "','" . date('c') . "','" . time() . "','" . $body . "')");
			}
		}
		
		dbquery("INSERT INTO site_minimail (sender_id,receiver_id,folder,is_read,subject,date,isodate,timestamp,body) VALUES ('" . USER_ID . "','" . USER_ID . "','sent','1','" . $subject . "','" . date('d-M-Y H:i:s') . "','" . date('c') . "','" . time() . "','" . $body . "')");
		header('X-JSON: {"message":"A mensagem foi enviada com sucesso.","totalMessages":' . mysql_result(dbquery("SELECT COUNT(*) FROM site_minimail WHERE folder = 'inbox'"), 0) . '}');
		
		$tpl->Init();
		
		$msgs = new Template('minimail-tabcontent');
		$msgs->SetParam('label', 'inbox');
	
		$tpl->AddTemplate($msgs);
		$tpl->Output();
		
		break;	
	
		break;

	case 'preview':
	
		if (!isset($_POST['body']))
		{
			exit;
		}
		
		die(nl2br(clean($_POST['body'])));

	case 'recipients':
	
		echo '/*-secure-' . LB;
		echo '[';
		
		$getBuddies = dbquery("SELECT user_two_id FROM messenger_friendships WHERE user_one_id = '" . USER_ID . "'");
		$i = 0;
		
		while ($buddy = mysql_fetch_assoc($getBuddies))
		{
			if ($i > 0)
			{
				echo ',';
			}
			
			echo '{"id":' . $buddy['user_two_id'] . ',"name":"' . clean($users->id2name($buddy['user_two_id'])) . '"}';
		
			$i++;
		}
		
		echo ']';
		echo LB . ' */';
		
		break;

	case 'emptytrash':
	
		dbquery("DELETE FROM site_minimail WHERE folder = 'trash' AND receiver_id = '" . USER_ID . "'");
		header('X-JSON: {"message":"Lixeira vazia!","totalMessages":' . mysql_result(dbquery("SELECT COUNT(*) FROM site_minimail WHERE folder = 'trash'"), 0) . '}');
		
		$tpl->Init();
		
		$msgs = new Template('minimail-tabcontent');
		$msgs->SetParam('label', 'trash');
	
		$tpl->AddTemplate($msgs);
		$tpl->Output();
		
		break;

	case 'undeletemessage':
	
		if (!isset($_POST['messageId']) && is_numeric($_POST['messageId']) || !isset($_POST['label']))
		{
			exit;
		}
		
		$messageId = intval($_POST['messageId']);
		$label = filter($_POST['label']);
		
		dbquery("UPDATE site_minimail SET folder = 'inbox', is_read = '1' WHERE id = '" . $messageId . "' AND receiver_id = '" . USER_ID . "' LIMIT 1");
		header('X-JSON: {"message":"A mensagem foi restaurada para a caixa de entrada.","totalMessages":' . mysql_result(dbquery("SELECT COUNT(*) FROM site_minimail WHERE folder = '" . $label . "'"), 0) . '}');
		
		$tpl->Init();
		
		$msgs = new Template('minimail-tabcontent');
		$msgs->SetParam('label', $_POST['label']);
	
		$tpl->AddTemplate($msgs);
		$tpl->Output();

		break;

	case 'deletemessage':
	
		if (!isset($_POST['messageId']) && is_numeric($_POST['messageId']) || !isset($_POST['label']))
		{
			exit;
		}
		
		$messageId = intval($_POST['messageId']);
		$label = filter($_POST['label']);
		
		if ($label == 'trash' || $label == 'sent')
		{
			dbquery("DELETE FROM site_minimail WHERE id = '" . $messageId . "' AND receiver_id = '" . USER_ID . "' LIMIT 1");
			header('X-JSON: {"message":"Message permanently deleted.","totalMessages":' . mysql_result(dbquery("SELECT COUNT(*) FROM site_minimail WHERE folder = '" . $label . "'"), 0) . '}');
		}
		else
		{
			dbquery("UPDATE site_minimail SET folder = 'trash', is_read = '1' WHERE id = '" . $messageId . "' AND receiver_id = '" . USER_ID . "' LIMIT 1");
			header('X-JSON: {"message":"The message has been moved to the trash. You can undelete it, if you wish.","totalMessages":' . mysql_result(dbquery("SELECT COUNT(*) FROM site_minimail WHERE folder = '" . $label . "'"), 0) . '}');
		}

		$tpl->Init();
		
		$msgs = new Template('minimail-tabcontent');
		$msgs->SetParam('label', $_POST['label']);
	
		$tpl->AddTemplate($msgs);
		$tpl->Output();
		
		break;
		
	case 'loadmessages':
	
		if (!isset($_POST['label']))
		{
			exit;
		}
		
		$tpl->Init();
		
		$msgs = new Template('minimail-tabcontent');
		$msgs->SetParam('label', $_POST['label']);
		
		if (isset($_POST['unreadOnly']))
		{
			$msgs->SetParam('unreadOnly', $_POST['unreadOnly']);
		}
		
		$tpl->AddTemplate($msgs);
		$tpl->Output();
		
		break;
		
	default:
	
		die($cmd);
}
	
?>