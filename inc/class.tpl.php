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

class uberTpl
{
	private $outputData;
	private $params = Array();
	private $includeFiles = Array();
	
	public function Init()
	{
		global $core, $users;
	        $this->SetParam('hotelName', 'Habbo');
		$this->SetParam('page_title', 'Habbo Hotel:');
		$this->SetParam('body_id', '');
		$this->SetParam('password', 'SUA SENHA');
		$this->SetParam('database', 'SUA DATABASE');
		$this->SetParam('HabboID', '<b><img src="' . WWW . '/images/id.png" style="vertical-align: middle;"> ' . $users->GetUserVar(USER_ID, 'mail') . '</b>');
		$this->SetParam('vipimage', '<img src="' . WWW . '/images/vipcoin.gif" style="vertical-align: middle;">');
		$this->SetParam('StaffEmail', 'lucastorres.ce@gmail.com');
		$this->SetParam('twitter', 'MakeCMS');
		$this->SetParam('', 'Holo');
		$this->SetParam('body_id', '');
		$this->SetParam('page_title', ' ');
		$this->SetParam('flash_build', 'flash_63_9');
		$this->SetParam('web_build', $core->GetPath());
		$this->SetParam('web_build_str', '63-BUILD?? - ?? - Novic - J.J.P.');
		$this->SetParam('req_path', WWW);
		$this->SetParam('www', WWW);
		$this->SetParam('hotel_status_fig', uberCore::GetSystemStatusString(true));
		$this->SetParam('hotel_status', uberCore::GetSystemStatusString(false));
		
		if (LOGGED_IN)
		{
			$this->SetParam('habboLoggedIn', 'true');
			$this->SetParam('habboName', USER_NAME);
			$this->SetParam('motto', $users->GetUserVar(USER_ID, 'motto'));
			$this->SetParam('last_online', $users->GetUserVar(USER_ID, 'last_online'));
			$this->SetParam('gender', $users->GetUserVar(USER_ID, 'gender'));
			$this->SetParam('activity_points', $users->GetUserVar(USER_ID, 'activity_points'));
			$this->SetParam('credits', $users->GetUserVar(USER_ID, 'credits'));
			$this->SetParam('mail', $users->GetUserVar(USER_ID, 'mail'));
			$this->SetParam('respect1', $users->GetUserVar(USER_ID, 'respect'));
			$this->SetParam('id', $users->GetUserVar(USER_ID, 'id'));
			$this->SetParam('account_created', $users->GetUserVar(USER_ID, 'account_created'));
			$this->SetParam('vipbalance', '<b>' . $users->GetUserVar(USER_ID, 'vip_points') . ' <img src="' . WWW . '/images/vipcoin.gif" style="vertical-align: middle;"></b>');
		}
		else
		{
			$this->SetParam('habboLoggedIn', 'false');
			$this->SetParam('habboName', 'null');
		}
	}
	
	public function AddIncludeSet($set)
	{
		switch (strtolower($set))
		{
			case "frontpage":
			
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/libs2.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/landing.js'));
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/frontpage.css', 'stylesheet'));			
				break;
				
			case "register":

				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/libs2.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/visual.js'));		
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/libs.js'));		
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/common.js'));
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/style.css', 'stylesheet'));		
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/buttons.css', 'stylesheet'));	
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/boxes.css', 'stylesheet'));	
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/tooltips.css', 'stylesheet'));
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/changepassword.css', 'stylesheet'));
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/forcedemaillogin.css', 'stylesheet'));
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/quickregister.css', 'stylesheet'));
				break;
		
			case "process-template":
			
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/libs2.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/visual.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/libs.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/common.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/fullcontent.js'));
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/style.css', 'stylesheet'));		
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/buttons.css', 'stylesheet'));	
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/boxes.css', 'stylesheet'));	
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/tooltips.css', 'stylesheet'));	
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/process.css', 'stylesheet'));	
				break;
				
			case 'myhabbo':
			
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/libs2.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/visual.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/libs.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/common.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/fullcontent.js'));
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/style.css', 'stylesheet'));		
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/buttons.css', 'stylesheet'));	
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/boxes.css', 'stylesheet'));	
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/tooltips.css', 'stylesheet'));				
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/styles/myhabbo/myhabbo.css', 'stylesheet'));
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/styles/myhabbo/skins.css', 'stylesheet'));
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/styles/myhabbo/dialogs.css', 'stylesheet'));
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/styles/myhabbo/buttons.css', 'stylesheet'));
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/styles/myhabbo/control.textarea.css', 'stylesheet'));
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/styles/myhabbo/boxes.css', 'stylesheet'));
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/myhabbo.css', 'stylesheet'));
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://www.habbo.co.uk/myhabbo/styles/assets.css', 'stylesheet'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/homeview.js'));
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/lightwindow.css', 'stylesheet'));
				break;


			case 'identity':
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/libs2.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/visual.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/libs.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/common.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/fullcontent.js'));
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/style.css', 'stylesheet'));		
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/buttons.css', 'stylesheet'));	
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/boxes.css', 'stylesheet'));	
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/tooltips.css', 'stylesheet'));	
				break;
			
			case 'default':
			default:
			
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/libs2.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/visual.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/libs.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/common.js'));
				$this->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/fullcontent.js'));
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/style.css', 'stylesheet'));		
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/buttons.css', 'stylesheet'));	
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/boxes.css', 'stylesheet'));	
				$this->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/tooltips.css', 'stylesheet'));		
				break;
		}
	}
	
	public function AddGeneric($tplName)
	{
		$tpl = new Template($tplName);
		$this->outputData .= $tpl->GetHtml();
	}
	
	public function AddTemplate($tpl)
	{
		$this->outputData .= $tpl->GetHtml();
	}
	
	public function SetParam($param, $value)
	{
		$this->params[$param] = is_object($value) ? $value->fetch() : $value;
	}
	
	public function UnsetParam($param)
	{
		unset($this->params[$param]);
	}
	
	public function AddIncludeFile($incFile)
	{
		$this->includeFiles[] = $incFile;
	}
	
	public function WriteIncludeFiles()
	{
		foreach ($this->includeFiles as $f)
		{
			$this->Write($f->GetHtml() . LB);
		}
	}
	
	public function Write($str)
	{
		$this->outputData .= $str;
	}
	
	public function FilterParams($str)
	{
		foreach ($this->params as $param => $value)
		{
			$str = str_ireplace('%' . $param . '%', $value, $str);
		}
		
		return $str;
	}
	
	public function Output()
	{
		global $core;
	
		$this->Write(LB . LB . '<!-- uberCMS: Took ' . (microtime(true) - $core->execStart) . ' to output this page -->' . LB . LB);
		
		echo $this->FilterParams($this->outputData);
	}
}

class Template
{
	private $params = Array();
	private $tplName = '';
	
	public function Template($tplName)
	{
		$this->tplName = $tplName;
	}
	
	public function GetHtml()
	{
		global $users;
	
		extract($this->params);
	
		$file = CWD . 'inc/tpl/' . $this->tplName . '.tpl';
	
		if (!file_exists($file))
		{
			uberCore::SystemError('Template system error', 'Could not load template: ' . $this->tplName);
		}
		
		ob_start();
		include($file);
		$data = ob_get_contents();
		ob_end_clean();	
		
		return $this->FilterParams($data);
	}
	
	public function FilterParams($str)
	{
		foreach ($this->params as $param => $value)
		{
			if (is_object($value))
			{
				continue;
			}
		
			$str = str_ireplace('%' . $param . '%', $value, $str);
		}
		
		return $str;
	}
	
	public function SetParam($param, $value)
	{
		$this->params[$param] = $value;
	}
	
	public function UnsetParam($param)
	{
		unset($this->params[$param]);
	}		
}

class IncludeFile
{
	private $type;
	private $src;
	private $rel;
	private $name;

	public function IncludeFile($type, $src, $rel = '', $name = '')
	{
		global $tpl;
	
		$this->type = $type;
		$this->src = $src;
		$this->rel = $rel;
		$this->name = $name;
	}
	
	public function GetHtml()
	{
		switch ($this->type)
		{
			case 'application/rss+xml':
			
				return '<link rel="' . $this->rel . '" type="' . $this->type . '" title="' . $this->name . '" href="' . $this->src . '" />';
		
			case 'text/javascript':
			
				return '<script src="' . $this->src . '" type="text/javascript"></script>';
				
			case 'text/css':
			default:
			
				return '<link rel="' . $this->rel . '" href="' . $this->src . '" type="' . $this->type . '" />';
		}
	}
}

?>