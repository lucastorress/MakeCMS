<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

$maintMode = mysql_result(dbquery("SELECT maintenance FROM site_config LIMIT 1"), 0);

if (isset($_GET['switch']))
{
	$newState = "1";

	if ($maintMode == "1")
	{
		$newState = "0";
	}
	
	dbquery("UPDATE site_config SET maintenance = '" . $newState . "' LIMIT 1");
	$maintMode = $newState;
}

require_once "top.php";

?>			

<h1>Manuten��o</h1>

<br />

<p>
	 Esta ferramenta, permite que usu�rios da administra��o, coloque o site em manuten��o para concertar v�rios erros e bugs. O modo de manuten��o pode ser usado para desativar o site e prevenir eficazmente a novos logons para o servidor. Por favor note que qualquer usu�rio ainda est� conectado ao servidor ou ter uma sess�o de login gerado por eles, ainda ser� capaz de utilizar o servidor at� que sejam desligados ou reinicializa��es.
</p>

<h2>
<?php

if ($maintMode == "1")
{
	echo '<span style="font-size: 120%; color: darkred;">O modo de manuten��o est� ativado. Membros de acesso regular n�o podem visualizar as p�ginas.</span><br /><input type="button" value="Retirar modo de manuten��o" onclick="document.location = \'index.php?_cmd=maint&switch\';">';
}
else
{
	echo 'Manuten��o est� desativada. Clique em "Ativar manuten��o" para colocar o site em reformas.<br /><input type="button" value="Ativar manuten��o" onclick="document.location = \'index.php?_cmd=maint&switch\';" style="color: darkred; font-weight: bold;">';
}

?>
</h2>

<?php

require_once "bottom.php";

?>