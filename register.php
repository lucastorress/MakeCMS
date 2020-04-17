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
require_once "inc/recaptchalib.php";

if (LOGGED_IN)
{
	header("Location: " . WWW . "/me");
	exit;
}

if (isset($_GET['cancal']))
{
	unset($_SESSION['jjp']['register']);
	header("Location: " . WWW . "/");
	exit;	
}

$tpl->SetParam('errors', '');
if(isset($_GET['errors']))
{
	$error = '<div id="error-messages-container" class="cbb"> 
            	<div class="rounded" style="background-color: #cb2121;"> 
               <div id="error-title" class="error"> 
								'.$_GET['errors'].'
							 </div> 
            </div> 
        </div>'; 
	$tpl->SetParam('errors', $error);
}

$tpl->Init();

$tpl->AddGeneric('head-init');
$tpl->AddIncludeSet('register');
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head-bottom');

switch($_GET['stap'])
{
	case "1":
		if (isset($_SESSION['jjp']['register'][1]))
			header("Location: " . WWW . "/quickregister/email_password");
	
		$tpl->AddGeneric('page-register-1');
		break;
		
	case "2":
		$bday_day = $_POST['bean_day'];
		$bday_month = $_POST['bean_month'];
		$bday_year = $_POST['bean_year'];
		$gender = $_POST['bean_gender'];
		
		if (!is_numeric($bday_day) || !is_numeric($bday_month) || !is_numeric($bday_year) || $bday_day <= 0 || $bday_day > 31 ||
			$bday_month <= 0 || $bday_month > 12 || $bday_year < 1900 || $bday_year > 2010)
		{
			$errors = "Por favor insira uma data v�lida de nascimento";
			
		}
		else if(!empty($gender))
		{
			$_SESSION['jjp']['register'][1]['bday_day'] = $bday_day;
			$_SESSION['jjp']['register'][1]['bday_month'] = $bday_month;
			$_SESSION['jjp']['register'][1]['bday_year'] = $bday_year;
			$_SESSION['jjp']['register'][1]['gender'] = $gender;
			header("Location: " . WWW . "/quickregister/email_password");
			exit;
		}
		else
		{
			$errors = "Escolher o sexo";
		}

		header("Location: " . WWW . "/quickregister/start/error/".$errors);
		exit;
		break;
	
	case "3":
		if (!isset($_SESSION['jjp']['register'][1]))
			header("Location: " . WWW . "/quickregister/start/error/Voc� deve fazer isso primeiro passo antes de prosseguir");
		else if (isset($_SESSION['jjp']['register'][2]))
			header("Location: " . WWW . "/quickregister/captcha");
		
		$tpl->AddGeneric('page-register-2');
		break;		
	
	case "4":
		$name = filter($_POST['bean_name']);
		$email = filter($_POST['bean_email']);
		$pass1 = filter($_POST['bean_password']);
		$pass2 = filter($_POST['bean_retypedPassword']);
		
		if (strlen($name) < 1 and strlen($name) > 32)
		{
			$errors = "Seu nome deve conter entre 1 e 32 caracteres";
		}
		else if ($users->IsNameTaken($name))
		{
			$errors = "Esse nome j� est� em uso";
		}
		else if ($users->IsNameBlocked($name))
		{
			$errors = "Esse nome est� bloqueado pela equipe.";
		}
		else if (!$users->IsValidName($name))
		{
			$errors = "Este nome n�o � v�lido";
		}		
		else if (!$users->IsValidEmail($email))
		{
			$errors = "N�o � um endere�o de e-mail v�lido";
		}
		else if ($pass1 <> $pass2 and strlen($pass1) < 6)
		{
			$errors = "As senhas n�o s�o iguais nem muito curto";
		}
		else if (isset($_POST['bean_termsOfServiceSelection']))
		{
			$_SESSION['jjp']['register'][2]['name'] = $name;
			$_SESSION['jjp']['register'][2]['email'] = $email;
			$_SESSION['jjp']['register'][2]['pass'] = $pass1;
			
			header("Location: " . WWW . "/quickregister/captcha");	
			exit;	
		}
		else
		{
			$errors = "Aceitar os Termos de servi�o";
		}
		
		header("Location: " . WWW . "/quickregister/email_password/error/".$errors);
		exit;
		break;
		
	case "5":
		if (!isset($_SESSION['jjp']['register'][1]))
			header("Location: " . WWW . "/quickregister/start/error/Voc� deve fazer isso primeiro passo antes de prosseguir");
		else if (!isset($_SESSION['jjp']['register'][2]))
			header("Location: " . WWW . "/quickregister/email_password/error/Voc� deve fazer isso primeiro passo antes de prosseguir");
	
	$tpl->SetParam('recaptcha_html', recaptcha_get_html("6Le-aQoAAAAAABnHRzXH_W-9-vx4B8oSP3_L5tb0"));
	$tpl->AddGeneric('page-register-3');
	break;	
	
	case "6":
		$resp = recaptcha_check_answer ('6Le-aQoAAAAAAKaqhlUT0lAQbjqokPqmj0F1uvQm', $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
							
		if (!$resp->is_valid)
		{
			$errors = "Captcha est� incorreto";
		}	
		else
		{
			if ($_SESSION['jjp']['register'][1]['gender'] == "male")
			{
				$look = 'hd-180-1.ch-210-66.lg-270-82.sh-290-91.hr-100-';
				$gender = 'M';
			}
			else
			{
				$look = 'hd-180-1.ch-210-66.lg-270-82.sh-290-91.hr-100-';
				$gender = 'F';
			}
				
			$users->add($_SESSION['jjp']['register'][2]['name'], $core->uberHash($_SESSION['jjp']['register'][2]['pass']), $_SESSION['jjp']['register'][2]['email'], 1, $look, $gender);
			
			$_SESSION['SHOW_WELCOME'] = true;
			$_SESSION['UBER_USER_N'] = $_SESSION['jjp']['register'][2]['name'];
			$_SESSION['UBER_USER_H'] = $core->uberHash($_SESSION['jjp']['register'][2]['pass']);
			
			unset($_SESSION['jjp']['register']);
			
			header("Location: " . WWW . "/quickregister/complete");
			exit;
		}
		
		header("Location: " . WWW . "/quickregister/captcha/error/".$errors);
		exit;
		break;		
}

$tpl->Output();

?>