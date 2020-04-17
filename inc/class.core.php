<?php
/*=======================================================================
| MakeCMS - A content management system for Habbo retro based on UberCMS
| #######################################################################
| Copyright (c) 2010, Roy 'Meth0d' & Lucas Torres (https://github.com/lucastorress)
| http://www.meth0d.org / https://www.sulake.com
| #######################################################################
| This program is free software: you can redistribute it and/or modify
| it under the terms of the GNU General Public License as published by
| the Free Software Foundation, either version 3 of the License, or
| (at your option) any later version.
| #######################################################################
| This program is distributed in the hope that it will be useful,
| but WITHOUT ANY WARRANTY; without even the implied warranty of
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
| GNU General Public License for more details.
\======================================================================*/

class uberCore
{
	public $config;
	public $execStart;

        public function getpath()
	{
		$url = file_get_contents("http://habbo.com/");
		$getpath = @explode('web/', $url);
		$getpath = @explode('/web', $getpath[1]);
		$getpath = trim($getpath[0]);
		if(empty($getpath)) 
			{
			$url = file_get_contents("http://www.habbo.com/");
			$getpath = explode('web/', $url);
			$getpath = explode('/web', $getpath[1]);
			$getpath = trim($getpath[0]);
			}
		return $getpath;
	}

	public function __construct()
	{
		$this->execStart = microtime(true);
	}	
	
	public static function CheckBetaKey($keyCode)
	{
		return (mysql_num_rows(dbquery("SELECT null FROM betakeys WHERE keyc = '" . filter($keyCode) . "' AND qty > 0 LIMIT 1")) > 0) ? true : false;
	}
	
	public static function EatBetaKey($keyCode)
	{
		dbquery("UPDATE betakeys SET qty = qty - 1 WHERE keyc = '" . filter($keyCode) . "' LIMIT 1");
	}
	
	public static function CheckCookies()
	{
		if (LOGGED_IN)
		{
			return;
		}
	
		if (isset($_COOKIE['rememberme']) && $_COOKIE['rememberme'] == "true" && isset($_COOKIE['rememberme_token']) && isset($_COOKIE['rememberme_name']))
		{
			$name = filter($_COOKIE['rememberme_name']);
			$token = filter($_COOKIE['rememberme_token']);
			$find = dbquery("SELECT id,username FROM users WHERE username = '" . $name . "' AND password = '" . $token . "' LIMIT 1");
			
			if (mysql_num_rows($find) > 0)
			{
				$data = mysql_fetch_assoc($find);
				
				$_SESSION['UBER_USER_N'] = $data['username'];
				$_SESSION['UBER_USER_H'] = $token;
				$_SESSION['set_cookies'] = true; // renew cookies
				
				header("Location: " . WWW . "/security_check");
				exit;				
			}
		}
	}
	
	public static function FormatDate()
	{
		return date('j F Y, h:i:s A');
	}
	
	public function UberHash($input = '')
	{
		return sha1($input . $this->config['Site']['hash_secret']);
	}
	
	public static function GenerateTicket($seed = '')
	{
		$ticket = "ST-";
		$ticket .= sha1($seed . 'Uber' . rand(118,283));
		$ticket .= '-' . rand(100, 255);
		$ticket .= '-uber-fe' . rand(0, 5);
		
		return $ticket;
	}
	
	public static function FilterInputString($strInput = '')
	{
		return mysql_real_escape_string(stripslashes(trim($strInput)));
	}
	
	public static function FilterSpecialChars($strInput, $allowLB = false)
	{
		$strInput = str_replace(chr(1), ' ', $strInput);
		$strInput = str_replace(chr(2), ' ', $strInput);
		$strInput = str_replace(chr(3), ' ', $strInput);
		$strInput = str_replace(chr(9), ' ', $strInput);
		
		if (!$allowLB)
		{
			$strInput = str_replace(chr(13), ' ', $strInput);
		}
		
		return $strInput;
	}
	
	public static function CleanStringForOutput($strInput = '', $ignoreHtml = false, $nl2br = false)
	{
		$strInput = stripslashes(trim($strInput));

		if (!$ignoreHtml)
		{
			$strInput = htmlentities($strInput);
		}
		
		if ($nl2br)
		{
			$strInput = nl2br($strInput);
		}

		return $strInput;
	}

	public static function SystemError($title, $text)
	{
		echo '<div style="width: 80%; padding: 15px 15px 15px 15px; margin: 50px auto; background-color: #F6CECE; font-family: arial; font-size: 12px; color: #000000; border: 1px solid #FF0000;">';
		echo '<img src="' . WWW . '/images/error.png" style="float: left;" title="Error">&nbsp;';
		echo '<b>' . $title. '</b><br />';
		echo '&nbsp;' . $text;
		echo '<hr size="1" style="width: 100%; margin: 15px 0px 15px 0px;" />';
		echo 'A execu��o do script foi cancelada. N�s pedimos desculpas para o inconveniente. Se o problema for persistente, entre em contato com um Administrador.';
		echo '</div><center style="font-family: arial; font-size: 10px;">Powered by LucasTorres, Copyright 2010 ~ 2011 &copy</center>';
		exit;		
	}
	
	public function ParseConfig()
	{
		$configPath = INCLUDES . 'inc.config.php';
		
		if (!file_exists($configPath))
		{
			$this->systemError('Erro de configura��o', 'A configura��o do arquivo est� redirecionada para ' . $configPath);
		}
		
		require_once $configPath;
		
		if (!isset($config) || count($config) < 2)
		{
			$this->systemError('Erro de configura��o', 'A configura��o do arquivo est� em formato errado ou em lugar errado.');
		}
		
		$this->config = $config;
		
		define('WWW', $this->config['Site']['www']);
	}
	
	public static function GetSystemStatusString($statsFig)
	{
		switch (uberCore::getSystemStatus())
		{
			case 2:
			case 0:
			
				return "O Hotel est� offiline";
				
			case 1:
			
				if (!$statsFig)
				{
					return uberCore::GetUsersOnline() . ' user(s) onlines.';
				}
				else
				{
					return '<span class="stats-fig">' . uberCore::GetUsersOnline() . '</span> Habbos onlines!';
				}
		
			default:
			
				return "Unknown";
		}
	}
	
	public static function GetSystemStatus()
	{
		return intval(mysql_result(dbquery("SELECT status FROM server_status LIMIT 1"), 0));
	}
	
	public static function GetUsersOnline()
	{
		return intval(mysql_result(dbquery("SELECT users_online FROM server_status LIMIT 1"), 0));
	}
	
	public static function GetMaintenanceStatus()
	{
		return mysql_result(dbquery("SELECT maintenance FROM site_config LIMIT 1"), 0);
	}
	
	public function Mus($header, $data = '')
	{
		if ($this->config['MUS']['enabled'] == false || $this->getSystemStatus() == "0")
		{
			return;
		}
		
		$musData = $header . chr(1) . $data;
		
		$sock = @socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'));
		@socket_connect($sock, $this->config['MUS']['ip'], intval($this->config['MUS']['port']));
		@socket_send($sock, $musData, strlen($musData), MSG_DONTROUTE);	
		@socket_close($sock);
	}
	
	public static function AddBan($type, $value, $reason, $expireTime, $addedBy, $blockAppeal)
	{
		dbquery("INSERT INTO bans (id,bantype,value,reason,expire,added_by,added_date,appeal_state) VALUES (NULL,'" . $type . "','" . $value . "','" . $reason . "','" . $expireTime . "','" . $addedBy . "','" . date('d/m/Y H:i') . "','" . (($blockAppeal) ? '0' : '1') . "')");
	}
}

?>