<?php
/*=======================================================================
| StageCMS - Sistema avan�ado de Administra��o de CMS
| #######################################################################
| Copyright (c) 2010, Geek and Meth0d
| #######################################################################
| Este programa � um Free Software aonde voc� pode editar os conte�dos
| com os direitos autorais do editor.
| #######################################################################
| Contato:                                       Divirta-se com a CMS ;D
|         rafa95123@hotmail.com
\======================================================================*/

if (!defined('UBER') || !UBER)
{
	exit;
}

$curStat = mysql_result(dbquery("SELECT status FROM server_status LIMIT 1"), 0);

if ($curStat == "1")
{
	$stamp = mysql_result(dbquery("SELECT stamp FROM server_status LIMIT 1"), 0);
	$diff = time() - $stamp;

	if ($diff >= 300)
	{
		dbquery("UPDATE server_status SET status = '2' LIMIT 1");
	}
}

?>