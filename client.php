<?php
/*=======================================================================
| Dayvso CMS - Leve sistema local para CMS
| #######################################################################
| Copyright (c) 2011, By 'dayvson1112'
| #######################################################################
| Este programa é software livre: você pode redistribuí-lo e / ou modificar
| Lo sob os termos da GNU General Public License como publicado pela
| A Free Software Foundation, tanto a versão 3 da Licença, ou
| (em sua opção) qualquer versão posterior.
| #######################################################################
| Este programa é distribuído na esperança que possa ser útil,
| mas SEM NENHUMA GARANTIA, nem mesmo a garantia implícita de
| COMERCIALIZAÇÃO ou ADEQUAÇÃO PARA UM DETERMINADO PROPÓSITO. Veja o
| GNU General Public License para mais detalhes.
\======================================================================*/
define('HIDE_FEEDBACK', true);

require_once "global.php";
require_once "inc/class.rooms.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW. "/login_popup");
	exit;
}

$forwardType = 0;
$forwardId = 0;

if ($users->getUserVar(USER_ID, 'newbie_status') == "0")
{
	if (isset($_GET['createRoom']) && is_numeric($_GET['createRoom']))
	{
		$roomId = RoomManager::CreateRoom(USER_NAME . "'s room", USER_NAME, 'model_s');

		switch (intval($_GET['createRoom']))
		{
			default:
			case 0:
			
				RoomManager::PaintRoom($roomId, '1701', '601');
				break;
				
			case 1:
			
				RoomManager::PaintRoom($roomId, '607', '111');
				break;
				
			case 2:
			
				RoomManager::PaintRoom($roomId, '1901', '301');
				break;
				
			case 3:
			
				RoomManager::PaintRoom($roomId, '1801', '110');
				break;
				
			case 4:
			
				RoomManager::PaintRoom($roomId, '503', '104');
				break;
				
			case 5:
			
				RoomManager::PaintRoom($roomId, '804', '107');
				break;
		}

		//die('createRoom Result: ' . $roomId);
		dbquery("UPDATE users SET home_room = '" . $roomId . "', newbie_status = '1' WHERE id = '" . USER_ID . "' LIMIT 1");
		
		//$forwardType = 2;
		//$forwardId = $roomId;
	}
	else
	{
		header("Location: " . WWW . "/client?createRoom=" . rand(0, 5));
		exit;
	}
}
else if (isset($_GET['forwardType']) && isset($_GET['forwardId']) && is_numeric($_GET['forwardType']) && is_numeric($_GET['forwardId']))
{
	$forwardType = intval($_GET['forwardType']);
	$forwardId = intval($_GET['forwardId']);
	
	if ($forwardType >= 3 || $forwardType <= 0)
	{
		return;
	}
}


$users->CheckSSO(USER_ID);

$tpl->Init();

$tpl->AddGeneric('head-init');
$tpl->AddIncludeSet('default');
$tpl->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/habboclient.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/habboflashclient.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/habboflashclient.js'));			
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head-bottom');

$client = new Template('page-client');
$client->SetParam('page_title', ' ');
$client->SetParam('sso_ticket', $users->GetUserVar(USER_ID, 'auth_ticket', false));
$client->SetParam('flash_base', 'http://www.swfs.host.crazzy.com.br/swf/r63/gordon/r_63/');
$client->SetParam('flash_client_url', 'http://www.swfs.host.crazzy.com.br/swf/r63/gordon/r_63/');
$client->SetParam('hotel_status', $core->GetUsersOnline() . ' Usuários online agora!');
$client->SetParam('forwardType', $forwardType);
$client->SetParam('forwardId', $forwardId);

if (isset($_GET['forceTicket']) && $users->HasFuse(USER_ID, 'fuse_admin'))
{
	$client->SetParam('sso_ticket', $_GET['forceTicket']);
}

$tpl->AddTemplate($client);

$tpl->Output();

?>