<?php
/*=======================================================================
| WareCMS - Sistema avan�ado de Administra��o de CMS
| #######################################################################
| Copyright (c) 2010, Lucas Reis & Dcr-Host
| #######################################################################
| Este programa � um FreeSoftware aonde voc� pode editar os conte�dos
| com os direitos autorais do editor.
| #######################################################################
| Este programa foi editado traduzido por Lucas Reis, cr�ditos totais
| para Meth0d, autor original do programa.
\======================================================================*/


define('IN_MAINTENANCE', true);

require_once "../global.php";
require_once "admincore.php";

$_cmd = null;

if (isset($_POST['_cmd']))
{
	$_cmd = strtolower(clean($_POST['_cmd']));
}

if ($_cmd == null && isset($_GET['_cmd']))
{
	$_cmd = strtolower(clean($_GET['_cmd']));
}

if ($_cmd == null)
{
	$initial = 'main';
	
	if (!HK_LOGGED_IN)
	{
		$initial = 'login';
		$_SESSION['HK_LOGIN_ERROR'] = "Nenhuma sess�o no Painel de Controle encontrada.";
	}

	header("Location: " . HK_WWW . "/index.php?_cmd=" . $initial);
	exit;
}

if (!HK_LOGGED_IN && $_cmd != 'login')
{
	header("Location: " . HK_WWW . "/index.php?_cmd=login");
	exit;
}

switch($_cmd)
{
	case 'ot-def':
	
		require_once 'pages/ot-def.php';
		break;

	case 'ot-pages':
	
		require_once 'pages/ot-pages.php';
		break;

	case 'ot-cata-items':
	
		require_once 'pages/ot-cata-items.php';
		break;

	case 'logout':
	
		session_destroy();
		session_start();
		
		$_SESSION['HK_LOGIN_ERROR'] = "Voc� se desconectou com sucesso.";
		
		header("Location: ./index.php?_cmd=login");
		exit;

	case 'login';
	case 'main';
	case 'home';
	
		if (HK_LOGGED_IN)
		{
			require_once 'pages/main.php';
		}
		else
		{
			require_once 'pages/login.php';
		}
		
		break;
		
	default:
	
		if (file_exists('pages/' . $_cmd . '.php') && HK_LOGGED_IN)
		{
			require_once 'pages/' . $_cmd . '.php';
		}
		else
		{
			require_once 'pages/404.php';
		}
		
		break;
}

?>