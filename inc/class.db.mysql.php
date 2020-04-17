<?php
/*=======================================================================
| MakeCMS - Sistema avançado de Administração de CMS
| #######################################################################
| Copyright (c) 2010, Lucas Torres and Meth0d
| #######################################################################
| Este programa é um Free Software aonde você pode editar os conteúdos
| com os direitos autorais do editor.
| #######################################################################
| Contato:
|         lucastorres.ce@gmail.com / sonhador_br@live.com
\======================================================================*/


class MySQL
{
	private $connected = false;
	private $hostname = "localhost";
	private $username = "root";
	private $password = "%password%";
	private $database = "%database%";
	private $link;
	
	public function MySQL($host, $user, $pass, $db)
	{
		$this->connected = false;	
		$this->hostname = $host;
		$this->username = $user;
		$this->password = $pass;
		$this->database = $db;
	}
	
	public function IsConnected()
	{
		if ($this->connected)
		{
			return true;
		}
		
		return false;
	}

	public function Connect()
	{
		$this->link = mysql_connect($this->hostname, $this->username, $this->password) or $this->error(mysql_error());
		mysql_select_db($this->database, $this->link) or $this->error(mysql_error());
	 	
		$this->connected = true;
	}
	
	public function Disconnect()
	{
		if($this->connected)
		{
			@mysql_close($this->link) or $this->error("could not close conn");
			$this->connected = false;
		}
	}
	
	public function DoQuery($query)
	{
		$resultset = @mysql_query($query, $this->link) or $this->error(mysql_error());
		return $resultset;
	}
	
	public function Evaluate($resultset)
	{
		return @mysql_result($resultset, 0);
	}
	
	public function Error($errorString)
	{
		global $core;
		
		$core->systemError('Erro no Banco de Dados. ', $errorString);
	}
	
	public function __destruct()
	{
		$this->disconnect();
	}
}

?>
