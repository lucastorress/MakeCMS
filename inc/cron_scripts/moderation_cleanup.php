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

$visitsCutoff = time() - 259200;
$chatlogsCutoff = time() - 1209600;

dbquery("DELETE FROM chatlogs WHERE timestamp <= " . $chatlogsCutoff);
dbquery("DELETE FROM user_roomvisits WHERE entry_timestamp <= " . $visitsCutoff);


?>