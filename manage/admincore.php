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


define('IN_HK', true);
define('HK_WWW', WWW . '/manage');

function fMessage($type, $message)
{
	if (isset($_SESSION['fmsg']))
	{
		return;
	}
	
	$_SESSION['fmsg_type'] = $type;
	$_SESSION['fmsg'] = $message;
}

if (isset($_SESSION['UBER_HK_USER_N']) && isset($_SESSION['UBER_HK_USER_H']))
{
	$userN = $_SESSION['UBER_HK_USER_N'];
	$userH = $_SESSION['UBER_HK_USER_H'];
	
	if ($users->validateUser($userN, $userH))
	{
		define('HK_LOGGED_IN', true);
		define('HK_USER_NAME', $userN);
		define('HK_USER_ID', $users->name2id($userN));
		define('HK_USER_HASH', $userH);
	}
	else
	{
		@session_destroy();
		header('Location: ./index.html');
		exit;
	}	
}
else
{
	define('HK_LOGGED_IN', false);
	define('HK_USER_NAME', 'Usuário');
	define('HK_USER_ID', -1);
	define('HK_USER_HASH', null);
}

?>