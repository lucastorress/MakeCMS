<?php
/*=======================================================================
| MakeCMS - Sistema avan�ado de Administra��o de CMS
| #######################################################################
| Copyright (c) 2010, Lucas Torres and Meth0d
| #######################################################################
| Este programa � um Free Software aonde voc� pode editar os conte�dos
| com os direitos autorais do editor.
| #######################################################################
| Contato:
|         lucastorres.ce@gmail.com / sonhador_br@live.com
\======================================================================*/

require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: ./index.html");
	exit;
}

echo '<b>The following users are currently online:</b>';

$getUsers = dbquery("SELECT id FROM users WHERE online = '1' ORDER BY activity_points_lastupdate DESC");

if (mysql_num_rows($getUsers) > 0)
{
	echo '<ul style="margin: 0;">';
	
	while ($u = mysql_fetch_assoc($getUsers))
	{
		echo '<li style="margin-left: 20px;">';
		echo $users->formatUsername($u['id']);
		echo '</li>';
	}
	
	echo '</ul>';
}
else
{
	echo '<br /><br /><i>N�o temos usu�rios onlines agora.</i>';
}

?>