<?php
/*=======================================================================
| StageCMS - Sistema avançado de Administração de CMS
| #######################################################################
| Copyright (c) 2010, Geek and Meth0d
| #######################################################################
| Este programa é um Free Software aonde você pode editar os conteúdos
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