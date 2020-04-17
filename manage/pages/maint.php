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

<h1>Manutenção</h1>

<br />

<p>
	 Esta ferramenta, permite que usuários da administração, coloque o site em manutenção para concertar vários erros e bugs. O modo de manutenção pode ser usado para desativar o site e prevenir eficazmente a novos logons para o servidor. Por favor note que qualquer usuário ainda está conectado ao servidor ou ter uma sessão de login gerado por eles, ainda será capaz de utilizar o servidor até que sejam desligados ou reinicializações.
</p>

<h2>
<?php

if ($maintMode == "1")
{
	echo '<span style="font-size: 120%; color: darkred;">O modo de manutenção está ativado. Membros de acesso regular não podem visualizar as páginas.</span><br /><input type="button" value="Retirar modo de manutenção" onclick="document.location = \'index.php?_cmd=maint&switch\';">';
}
else
{
	echo 'Manutenção está desativada. Clique em "Ativar manutenção" para colocar o site em reformas.<br /><input type="button" value="Ativar manutenção" onclick="document.location = \'index.php?_cmd=maint&switch\';" style="color: darkred; font-weight: bold;">';
}

?>
</h2>

<?php

require_once "bottom.php";

?>