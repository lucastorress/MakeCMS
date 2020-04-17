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

define('BAN_PAGE', true);

require_once "global.php";

$ban = null;

if (uberUsers::IsIpBanned(USER_IP))
{
	$ban = uberUsers::GetBan('ip', USER_IP, true);
}

if (LOGGED_IN && uberUsers::IsUserBanned(USER_NAME))
{
	$ban = uberUsers::GetBan('user', USER_NAME, true);
}

if ($ban == null)
{
	header("Location: " . WWW . "/");
	exit;
}

$tpl->Init();

$tpl->AddGeneric('head-init');
$tpl->AddIncludeSet('process-template');
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head-overrides-process');
$tpl->AddGeneric('head-bottom');
$tpl->AddGeneric('process-template-top');

$tpl->Write('<h2>Você está banido ! ' . (LOGGED_IN ? '<small style="font-weight: normal; font-size: 60%;">(<a href="%www%/logout.html">Sair</a>)</small>' : '') . '</h2>');
$tpl->Write('<img align="right" src="%www%/images/banned.php">');
$tpl->Write('<p>Você está banido do %hotelName% pelo seguinte motivo:</p>');
$tpl->Write('<p style="margin-top: 5px; margin-bottom: 5px; font-size: 110%;"><b>' . clean($ban['reason'], false, true) . '</b></p>');
$tpl->Write('<p>Você foi banido no dia <b>' . $ban['added_date'] . '</b> e ele irá expirar no dia <b>' . date('d F, Y', $ban['expire']) . '</b> agora são <b>' . ceil(($ban['expire'] - time()) / 86400) . '</b> dias para ser desbanido.</p>');
$tpl->Write('<p>De acordo com o servdor, seu IP é <b>' . USER_IP . '</b>. ' . (($ban['bantype'] == 'user') ? 'O nome associado para banimento é <b>' . clean($ban['value']) . '</b>.' : 'Não há nome associado para esse banimento.') . '</p>');

if ($ban['appeal_state'] == "1" && ($ban['expire'] - time()) >= 259200)
{
	$tpl->Write('Devido a sua proibição é mais do que 3 dias de duração, você pode recorrer a proibição por meio do formulário abaixo. Por favor, explique porque você acha que merece ser banido. Rude, mal escrito, ou recursos ofensivo será recusado. Interposição de recurso não garante nem implica que a sua proibição será levantada antes de sua data de validade indicados. Endereço e-mail é opcional, porém se você não fornecer um, seremos incapazes de contatá-lo com perguntas e / ou atualizações.');
}
else if ($ban['appeal_state'] == "1")
{
	$tpl->Write('Devido a sua proibição vai expirar dentro de três dias, você não poderá apelar da proibição.');
}
else if ($ban['appeal_state'] == "0")
{
	$tpl->Write('<b style="color: darkred;">Esta proibição é final e você não estão autorizados a apresentar um recurso contra ela.</b>');
}
else if ($ban['appeal_state'] == "2")
{
	$tpl->Write('<b style="color: darkred;">Seu recurso foi revisto e diminuído. Você não poderá apelar da proibição de novo.</b>');
}

if ($ban['appeal_state'] == "1" && ($ban['expire'] - time()) >= 259200)
{				
	$tpl->Write('<h2>Recursos do banimento</h2>
	<form method="post" id="appealform" style="width: 60%;">');
					
	if (isset($_POST['appeal-plea']))
	{			
		$mail = filter($_POST['appeal-email']);
		$plea = filter($_POST['appeal-plea']);
		
		if (strlen($plea) >= 1)
		{
			dbquery("UPDATE bans_appeals SET send_ip = '" . USER_IP . "', send_date = '" . date('d F, Y') . "', mail = '" . $mail . "', plea = '" . $plea . "' WHERE ban_id = '" . $ban['id'] . "' LIMIT 1");
		}
	}

	$query = dbquery("SELECT * FROM bans_appeals WHERE ban_id = '" . intval($ban['id']) . "' LIMIT 1");

	if (mysql_num_rows($query) <= 0)
	{
		dbquery("INSERT INTO bans_appeals (ban_id) VALUES ('" . intval($ban['id']) . "')");
	}			

	$adata = mysql_fetch_assoc($query);				

	if (strlen($adata['plea']))
	{
		$tpl->Write('<b style="color: darkred;">Obrigado. Seu recurso foi apresentado e será analisada por um membro da equipe em breve. Enquanto espera por reviewal você pode fazer modificações se desejar.</b>');
	}
					
	$tpl->Write('<p>
	<table width="100%">
	<tr>
		<td valign="middle">
			<b>E-Mail:</b>
		</td>
		<td valign="middle">
			<input name="appeal-email" type="text" size="43" value="' . clean($adata['mail']) . '">
		</td>
	</tr>
	<tr>
		<td valign="middle">
			<b>Apelo:</b>
		</td>
		<td valign="middle">
			<textarea name="appeal-plea" cols="43" rows="4">' . clean($adata['plea']) . '</textarea>
		</td>
	</tr>
	<tr>
		<td valign="middle">
			&nbsp;
		</td>
		<td valign="middle">
			<br />
			<a href="#" onclick="document.getElementById(\'appealform\').submit(); return false" class="pretty-button">
				Enviar apelo
			</a>
		</td>
	</tr>
	</table>
	</p>');
}

$tpl->AddGeneric('process-template-bottom');
$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', 'Home');

$tpl->Output();

?>