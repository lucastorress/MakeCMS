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

?>
<html>
<head>
<title>MakeCMS ~ Housekeeping</title>
<style type="text/css">
* {
	margin: 0;
	padding: 0;
}

body {
	font-family: sans-serif;
	font-size: 12px;
}

table {
	font-size: 12px;
}

table thead {
	font-weight: bold;
}

#menu {
	padding: 5px;
}

a {
	color: #35415C;
	text-decoration: none;
	font-weight: normal;
}

a:hover {
	text-decoration: underline;
}

#menu li {
	margin: 0px;
}

#menu li:hover {
	background: #f6f7fe;
}

#menu li a {
	display: block;
	width: 100%;
}

h1, h2 {
	background: #EFF0F9;
	text-align: left;
}

h1 {
	margin-top: 0px;
	font-size: 140%;
	padding: 3px;
	color: #000;
}

h2 {
	margin: 0;
	font-size: 100%;
	margin-top: 1em;
	padding: 3px;
}

#main {
	padding: 5px;
}

.plus {
	float: right;
	font-size: 8px;
	font-weight: normal;
	padding: 1px 4px 2px 4px;
	margin: 0px 0px;
	background: #f6f7fe;
	color: #000;
	border: 1px solid #b4b8d0;
	cursor: pointer;
}

.plus:hover {
	background: #f6f7fe;
	border: 1px solid #c97;
}

ul.listmnu {
	list-style: none;
}

.listmnu {
	padding: 5px;
	text-align: left;
}

#top-flashmessage-ok {
	background-color: #E0F8E0;
	color: #088A08;
}

#top-flashmessage-error {
	background-color: #F8E0E0;
	color: #8A0808;
}

#top-flashmessage-ok,#top-flashmessage-error {
	font-family: arial, san-serif;
	border: 1px solid #2E2E2E;
	font-size: 14px;
	font-weight: bold;
	text-align: center;
	padding: 5px;
	margin-bottom: 10px;
}

table td
{
	padding: 3px;
}
</style>
<script type="text/javascript">

function Toggle(id)
{
	var List = document.getElementById('list-' + id);
	var Button = document.getElementById('plus-' + id);
	
	if (List.style.display == 'block' || List.style.display == '')
	{
		List.style.display = 'none';
		Button.innerHTML = '+';
	}
	else
	{
		List.style.display = 'block';
		Button.innerHTML = '-';
	}
	
	setCookie('tab-' + id, List.style.display, 9999);	
}

function t(id)
{
	var el = document.getElementById(id);
	
	if (el.style.display == 'block' || el.style.display == '')
	{
		el.style.display = 'none';
	}
	else
	{
		el.style.display = 'block';
	}
}

function setCookie(c_name,value,expiredays)
{
	var exdate=new Date();
	exdate.setDate(exdate.getDate()+expiredays);
	document.cookie=c_name+ "=" +escape(value)+
	((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
}

function checkCookies()
{
	ca = document.cookie.split(';');

	for (i = 0; i < ca.length; i++)
	{
		bits = ca[i].split('=');
		
		key = trim(bits[0]);
		value = trim(bits[1]);
		
		if (key.substr(0, 3) == 'tab')
		{
			tabName = key.substr(4);
			
			if (value == 'none')
			{
				Toggle(tabName);
			}
		}
	}
}

function trim(value)
{
	value = value.replace(/^\s+/,''); 
	value = value.replace(/\s+$/,'');
	return value;
}

function popClient()
{
	window.open('/client', 'Habbo Hotel BETA', 'width=980,height=600,location=no,status=no,menubar=no,directories=no,toolbar=no,resizable=no,scrollbars=no'); return false;
}

function popSsoClient(sso)
{
	window.open('/client.php?forceTicket=' + sso, 'uberHotel BETA', 'width=980,height=600,location=no,status=no,menubar=no,directories=no,toolbar=no,resizable=no,scrollbars=no'); return false;
}
</script>
</head>
<body onLoad="checkCookies();">

<table width="100%">
<tr>
	<td id="menu" style="width: 17%;" valign="top">
		
		<h1>Housekeeping</h1>
		<ul class="listmnu">
			<li><b><?php echo $users->formatUsername(HK_USER_ID); ?></b> <?php echo $users->getRankName($users->getUserVar(USER_ID, 'rank')); ?></li>
		</ul>
		
		<h2>
   Principal
			<a href="#" onClick="Toggle('main'); return false"><div class="plus" id="plus-main">-</div></a>		
		</h2>
		<ul id="list-main" class="listmnu">
			<li><a href="index.php?_cmd=main">P�gina Principal</a></li>
			<?php if($users->hasFuse(HK_USER_ID, 'fuse_admin')){ ?><li><a href="index.php?_cmd=todo"><b>Agenda de programa��es</b></a></li><?php } ?>
			<li><a href="/">Voltar para o site</a></li>
			<li><a href="/client" onClick="popClient(); return false">Abrir o jogo</a>
			<li><a href="index.php?_cmd=forum" style="color: darkred;">Discu��o da equipe</a></li>
			<li><a href="index.php?_cmd=getstaff">Equipe Habbo</a></li>
			<li><a href="index.php?_cmd=logout">Desconectar</a></li>
		</ul>		
		
		<?php if ($users->hasFuse(USER_ID, 'fuse_admin')) { ?>
		<h2>
   Administra��o do Hotel
			<a href="#" onClick="Toggle('hotel'); return false"><div class="plus" id="plus-hotel">-</div></a>		
		</h2>
		<ul id="list-hotel" class="listmnu">
			<li><a href="index.php?_cmd=maint"><b>Manuten��o</b></li>
			<li><a href="index.php?_cmd=roomads">ADS nos quartos</a></li>
			<li><a href="index.php?_cmd=badges">Visualizar emblemas</a></li>
			<li><a href="index.php?_cmd=badgedefs">Defini��es dos emblemas</a></li>
			<li><a href="index.php?_cmd=presets">MOD TOOL (Hotel)</a></li>
			<li><a href="index.php?_cmd=extsignon">External Login</a></li>
			<li><a href="index.php?_cmd=texts">External Texts</a></li>
			<li><a href="index.php?_cmd=vars">External Variables</a></li>
			<li><a href="index.php?_cmd=ha">Alertar o Hotel</a></li>
		</ul>
		<?php } ?>
		
		<?php if ($users->hasFuse(USER_ID, 'fuse_housekeeping_moderation')) { ?>
		<h2>
   Ajuda aos membros e Modera��o
			<a href="#" onClick="Toggle('mod'); return false"><div class="plus" id="plus-mod">-</div></a>		
		</h2>
		<ul id="list-mod" class="listmnu">
			<li><a href="index.php?_cmd=bans">Visualizar banimentos</a></li>
			<li><a href="index.php?_cmd=iptool">Endere�o de IP</a></li>
			<li><a href="index.php?_cmd=chatlogs">Conversas</a></li>
			<li><a href="index.php?_cmd=adminlook">Editar usu�rios</a></li>
			<li><a href="index.php?_cmd=cfhs">Pedidos de ajudas</a></li>
			<li><a href="index.php?_cmd=vouchers">C�digos de Moedas</a></li>
		</ul>
		<?php } ?>
		
		<?php if ($users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement')) { ?>
		<h2>
   Administra��o do Website
			<a href="#" onClick="Toggle('site'); return false"><div class="plus" id="plus-site">-</div></a>		
		</h2>
		<ul id="list-site" class="listmnu">
			<li><a href="index.php?_cmd=campaigns">Nova campanha</a></li>
			<li><a href="index.php?_cmd=newspublish">Escrever not�cia</a></li>
			<li><a href="index.php?_cmd=news">Administrar not�cias</a></li>
			<li><a href="index.php?_cmd=jobapps">Ver formul�rios</a></li>
			<li><a href="index.php?_cmd=jobopenings">Usu�rios merecedores</a></li>
			<li><a href="index.php?_cmd=jobform">Criar lista de emprego</a></li>
		</ul>
		<?php } ?>		
		
		<?php if ($users->hasFuse(USER_ID, 'fuse_housekeeping_catalog')) { ?>
		<h2>
			Cat�logo
			<a href="#" onClick="Toggle('cata'); return false"><div class="plus" id="plus-cata">-</div></a>		
		</h2>
		<ul id="list-cata" class="listmnu">
			<li><a href="index.php?_cmd=ot-def">Defini��es dos itens</a></li>
			<li><a href="index.php?_cmd=ot-pages">P�ginas do cat�logo</a></li>
			<li><a href="index.php?_cmd=ot-cata-items">Itens do cat�logo</a></li>
			<li><a href="index.php?_cmd=furnifinder">Procurar Mobis</a></li>
		</ul>
	
		<?php } ?>
		
		<h2>
   Info Hotel
			<a href="#" onClick="Toggle('sys'); return false"><div class="plus" id="plus-sys">-</div></a>		
		</h2>		
		<p id="list-sys" class="listmnu">
		<?php
		
		$sysData = mysql_fetch_assoc(dbquery("SELECT * FROM server_status"));	
		echo $sysData['server_ver'] . '<br /><br />';
		
		switch ($sysData['status'])

		{
			case 0:
			
				echo 'Atualmente o hotel se encontra <b style="color: red;">offline</b>.';
				
				break;
				
			case 1:
			
				echo 'Hotel <b style="color: darkgreen;">online</b>.';
				echo '<br /><br />';
				echo 'Temos : <a style="text-decoration: underline; " href="/onlineusers.html">' . $sysData['users_online'] . '</a> usu�rios online<br />';
				echo '' . $sysData['rooms_loaded'] . 'quartos carregados<br />';
				
				break;
		
			default:
			
				echo 'O hotel se encontra <b style="color: red;">offline</b>.';
				
				break;
		}
		
		unset($sysData);
		
		?>
		</p>
		
	</td>
	<td id="spacer" style="width: 5px;" valign="middle">&nbsp;
		
	</td>
	<td id="main" valign="top">

<?php

if (isset($_SESSION['fmsg']) && $_SESSION['fmsg'] != null)
{
	$icon = '';
	
	switch ($_SESSION['fmsg_type'])
	{
		case 'error':
			
			$icon = 'cross.png';
			break;
	
		case 'ok':
		default:
		
			$icon = 'accept.png';
			break;
	}

	echo '<div id="top-flashmessage-' . $_SESSION['fmsg_type'] . '">

		<div id="wrapper">
		
			<img src="' . WWW . '/images/' . $icon . '" style="vertical-align: middle;">
			' . $_SESSION['fmsg'] . '
		
		</div>

	</div>';
	
	$_SESSION['fmsg'] = null;
	$_SESSION['fmsg_type'] = null;
}

?>
