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

$tpl->Write('<h2>Voc� est� banido ! ' . (LOGGED_IN ? '<small style="font-weight: normal; font-size: 60%;">(<a href="%www%/logout.html">Sair</a>)</small>' : '') . '</h2>');
$tpl->Write('<img align="right" src="%www%/images/banned.php">');
$tpl->Write('<p>Voc� est� banido do %hotelName% pelo seguinte motivo:</p>');
$tpl->Write('<p style="margin-top: 5px; margin-bottom: 5px; font-size: 110%;"><b>' . clean($ban['reason'], false, true) . '</b></p>');
$tpl->Write('<p>Voc� foi banido no dia <b>' . $ban['added_date'] . '</b> e ele ir� expirar no dia <b>' . date('d F, Y', $ban['expire']) . '</b> agora s�o <b>' . ceil(($ban['expire'] - time()) / 86400) . '</b> dias para ser desbanido.</p>');
$tpl->Write('<p>De acordo com o servdor, seu IP � <b>' . USER_IP . '</b>. ' . (($ban['bantype'] == 'user') ? 'O nome associado para banimento � <b>' . clean($ban['value']) . '</b>.' : 'N�o h� nome associado para esse banimento.') . '</p>');

if ($ban['appeal_state'] == "1" && ($ban['expire'] - time()) >= 259200)
{
	$tpl->Write('Devido a sua proibi��o � mais do que 3 dias de dura��o, voc� pode recorrer a proibi��o por meio do formul�rio abaixo. Por favor, explique porque voc� acha que merece ser banido. Rude, mal escrito, ou recursos ofensivo ser� recusado. Interposi��o de recurso n�o garante nem implica que a sua proibi��o ser� levantada antes de sua data de validade indicados. Endere�o e-mail � opcional, por�m se voc� n�o fornecer um, seremos incapazes de contat�-lo com perguntas e / ou atualiza��es.');
}
else if ($ban['appeal_state'] == "1")
{
	$tpl->Write('Devido a sua proibi��o vai expirar dentro de tr�s dias, voc� n�o poder� apelar da proibi��o.');
}
else if ($ban['appeal_state'] == "0")
{
	$tpl->Write('<b style="color: darkred;">Esta proibi��o � final e voc� n�o est�o autorizados a apresentar um recurso contra ela.</b>');
}
else if ($ban['appeal_state'] == "2")
{
	$tpl->Write('<b style="color: darkred;">Seu recurso foi revisto e diminu�do. Voc� n�o poder� apelar da proibi��o de novo.</b>');
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
		$tpl->Write('<b style="color: darkred;">Obrigado. Seu recurso foi apresentado e ser� analisada por um membro da equipe em breve. Enquanto espera por reviewal voc� pode fazer modifica��es se desejar.</b>');
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