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

	
	require_once "global.php";
	require_once "inc/recaptchalib.php";
	
	if (!LOGGED_IN)
	{
		header("Location: " . WWW . "/");
		exit;
	}
	else if ($users->GetUserVar(USER_ID, 'newbie_status') == "0")
	{
		header("Location: " . WWW . "/register/welcome");
		exit;
	}
	
	// Initialize template system
	$tpl->Init();
	
	// Errors
	$tpl->SetParam('errors', '');
	if (isset($_GET['errors']))
	{
		$error = '<div id="error-messages-container" style="margin: 5px; margin-top: 10px;">

            <div class="error-messages-holder">

                <h3>Alterar algumas informações, e tente novamente.</h3>

                <ul>

                    <li><p class="error-message">'.$_GET['errors'].'.</p></li>

                </ul>

            </div>

            </div>';
            
  	$tpl->SetParam('errors', $error);
	}
	
	$type = $_GET['type'];
	
	// Initial variables
	$tpl->SetParam('page_title', 'Habbo ID');
	
	// Generate page header
	$tpl->AddGeneric('head-init');
	$tpl->AddIncludeSet('identity');

	if ($type == "password")
	{
		$tpl->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/changepassword.css', 'stylesheet'));
		$tpl->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/embeddedregistration.css', 'stylesheet'));/**/
	}

	$tpl->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/identity_settings.css', 'stylesheet'));
		
	if ($type == "avatars" or $type == "add_avatar")
		$tpl->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/avatarselection.css', 'stylesheet'));			
	
	$tpl->WriteIncludeFiles();
	$tpl->AddGeneric('head-bottom');
	
	// Habbo name check
	$tpl->AddGeneric('check-name');
	
	switch ($type)
	{
		case "avatars":
			dbquery("UPDATE `users` SET `real_name` = '".$_SESSION['jjp']['login']['name']."' WHERE `mail` = '".$_SESSION['jjp']['login']['email']."'");
			$tpl->AddGeneric('identity-avatars');
			break;
		
		case "add_avatar":
			$tpl->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/avatarselection.css', 'stylesheet'));
			$tpl->AddGeneric('identity-add-avatars');
			break;
		
		case "add_avatar_add":
			$userP = $_SESSION['UBER_USER_H'];
			$userL = filter($_POST['bean_look']);
			$userN = filter($_POST['bean_avatarName']);
			$userE = $_SESSION['jjp']['login']['email'];
			$gender = filter($_POST['bean_gender']);
			
			if (strlen($userN) < 1 and strlen($userN) > 32)
			{
				$errors = "Seu nome deve estar entre 1 e 32 caracteres";
			}
			else if ($users->IsNameTaken($userN))
			{
				$errors = "Esse nome já está em uso";
			}
			else if ($users->IsNameBlocked($userN))
			{
				$errors = "Esse nome é bloqueada pela equipe habbo";
			}
			else if (!$users->IsValidName($userN))
			{
				$errors = "Este nome não é válido";
			}		
			
			if (!isset($errors))
			{			
				$users->add($userN, $userP, $userE, 1, $userL, $gender);
				
				dbquery("UPDATE `users` SET `real_name` = '".$_SESSION['jjp']['login']['name']."' WHERE `mail` = '".$_SESSION['jjp']['login']['email']."'");
				
				$_SESSION['SHOW_WELCOME'] = true;
				$_SESSION['UBER_USER_N'] = $userN;
				
				$_SESSION['jjp']['login']['user'] = $_SESSION['UBER_USER_N'];
				$_SESSION['jjp']['login']['email'] = $users->GetUserVar($users->Name2id($_SESSION['jjp']['login']['user']), 'mail');
				$_SESSION['jjp']['login']['name'] = $users->GetUserVar($users->Name2id($_SESSION['jjp']['login']['user']), 'real_name');
				
				header("Location: " . WWW . "/quickregister/complete");
				exit;
			}
			
			header("Location: " . WWW . "/identity/add_avatar/error/".$errors);
			exit;				
			break;			
		
		case "useOrCreateAvatar":
			if ($users->GetUserVar($_GET['param'], 'mail') == $_SESSION['jjp']['login']['email'] and $users->GetUserVar($_GET['param'], 'password') == $_SESSION['UBER_USER_H'])
				$_SESSION['UBER_USER_N'] = $users->GetUserVar($_GET['param'], 'username');
			else
			{
				header("Location: " . WWW . "/identity/avatars/error/Você não pode ligar-se nesta conta");
				exit;
			}
				
			header('Location: '.WWW.'/');
			exit;
			
			break;
			
		case "settings":
			$tpl->AddGeneric('identity-settings');
			break;
			
		case "password":
			$tpl->SetParam('recaptcha_html', recaptcha_get_html("6Le-aQoAAAAAABnHRzXH_W-9-vx4B8oSP3_L5tb0"));
			$tpl->AddGeneric('identity-password');
			break;
			
		case "password_change":
			$userP = $_SESSION['UBER_USER_H'];
			$userE = $_SESSION['jjp']['login']['email'];
			$userCP = $core->uberHash($_POST['currentPassword']);
			$userNP = $_POST['newPassword'];
			$userNPA = $_POST['retypedNewPassword'];
			
			$resp = recaptcha_check_answer ('6Le-aQoAAAAAAKaqhlUT0lAQbjqokPqmj0F1uvQm', $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
			if (!$resp->is_valid)
			{
				$error = "Código Captcha não é válido";
			}	
			else if ($userP <> $userCP)
			{
				$error = "Sua senha não é igual a sua senha antiga";
			}
			else if ($userNP <> $userNPA)
			{
				$error = "Sua nova senha não é igual à sua senha redigite";
				exit;
			}
			else if (strlen($userNP) < 6)
			{
				$error = "Sua nova senha é muito curta";
			}
			else if (!isset($error))
			{
				$newPass = $core->uberHash($userNP);
				$result = dbquery("UPDATE `users` SET `password` = '".$newPass."' WHERE `mail` = '".$userE."'");
				if ($result)
				{
					$_SESSION['UBER_USER_H'] = $newPass;
					header("Location: " . WWW . "/identity/settings&passwordChanged=true");
				}
				else
				{
					$error = "Sua senha foi salva!";
				}
			}
			
			header("Location: " . WWW . "/identity/password/error/".$error);
			exit;
			
			break;
	}
	
	// Footer
	$tpl->AddGeneric('footer');
	
	// Output the page
	$tpl->Output();
	
?>