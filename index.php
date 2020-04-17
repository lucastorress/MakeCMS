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

require_once "global.php";	
	
if (LOGGED_IN)
{
	header("Location: " . WWW . "/me");
	exit;
}

$tpl->Init();

$tpl->SetParam('page_title', 'Crie seu Habbo, construa seu Quarto, converse e fa�a novos amigos.');
$tpl->SetParam('credentials_username', '');

$tpl->AddGeneric('head-init');
$tpl->AddIncludeSet('frontpage');
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head-overrides-fp');
$tpl->AddGeneric('head-bottom');

$frontpage = new Template('page-fp');
$frontpage->SetParam('login_result', '');

if (isset($_POST['credentials_username']) && isset($_POST['credentials_password']))
{
	$frontpage->SetParam('credentials_username', $_POST['credentials_username']);

	$credUser = filter($_POST['credentials_username']);
	$credPass = $core->UberHash($_POST['credentials_password']);
	
	$errors = array();
	
	if (strlen($_POST['credentials_username']) < 1)
	{
		$errors[] = "Digite seu nome de usu�rio.";
	}
	
	if (strlen($_POST['credentials_password']) < 1)
	{
		$errors[] = "Digite sua senha.";
	}
	
	if (count($errors) == 0)
	{
		$check = $users->ValidateLogin($credUser, $credPass);
		if ($check[0])
		{
			if (isset($_POST['page']))
			{
				$reqPage = filter($_POST['page']);
				$pos = strrpos($reqPage, WWW);
			
				if ($pos === false || $pos != 0)
				{
					die("<b>Security warning!</b> A malicious request was detected that tried redirecting you to an external site. Please proceed with caution, this may have been an attempt to steal your login details. <a href='" . WWW . "'>Return to site</a>");
				}
				else
				{
					$_SESSION['page-redirect'] = $reqPage;
				}
			}			
					
			if (!$check[1])
				$_SESSION['UBER_USER_N'] = $users->GetUserVar($users->Name2id($credUser), 'username');
			else
			{
				$_SESSION['UBER_USER_N'] = $users->GetUserVar($users->Email2id($credUser), 'username');
				if ($check[2] > 1)
					$_SESSION['page-redirect'] = "identity/avatars";
			}
			$_SESSION['UBER_USER_H'] = $credPass;
			
			if (isset($_POST['_login_remember_me']))
			{
				$_SESSION['set_cookies'] = true;
			}
			
			$_SESSION['jjp']['login']['user'] = $_SESSION['UBER_USER_N'];
			$_SESSION['jjp']['login']['email'] = $users->GetUserVar($users->Name2id($_SESSION['jjp']['login']['user']), 'mail');
			$_SESSION['jjp']['login']['name'] = $users->GetUserVar($users->Name2id($_SESSION['jjp']['login']['user']), 'real_name');
			
			header("Location: " . WWW . "/beveilegings_check.php");
			exit;
		}
		else
		{
			$errors[] = "Senha incorreta";
		}
	}

	if (count($errors) > 0)
	{
		$loginResult = '<center><div class="action-error flash-message"><div class="rounded"><ul>';

		foreach ($errors as $err)
		{
			$loginResult .= '<li>' . $err . '</li>';
		}
		
		$loginResult .= '</ul></div></div></center>';
		
		$frontpage->SetParam('login_result', $loginResult);
	}
}

$tpl->AddTemplate($frontpage);

$tpl->Output();

?>