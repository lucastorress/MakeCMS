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

dbquery("UPDATE users SET credits = '3000' WHERE credits < 3000");
$core->Mus('updateCredits', 'ALL');

?>