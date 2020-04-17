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

class uberCron
{
	function Execute()
	{
		$query = dbquery("SELECT id FROM site_cron WHERE enabled = '1' ORDER BY prio ASC");
		
		while ($job = mysql_fetch_assoc($query))
		{
			if ($this->GetNextExec($job['id']) <= time())
			{
				$this->RunJob($job['id']);
			}
		}
	}
	
	function RunJob($jobId)
	{
		global $core;
		
		$script = mysql_result(dbquery("SELECT scriptfile FROM site_cron WHERE id = '" . $jobId . "' LIMIT 1"), 0);
		
		if (!$this->CheckScript($script))
		{
			$core->SystemError('Cron Error', 'Could not execute cron job \'' . $script . '\': could not locate script file.');
			return;
		}

		require_once INCLUDES . 'cron_scripts' . DS . $script;
		
		dbquery("UPDATE site_cron SET last_exec = '" . time() . "' WHERE id = '" . $jobId . "' LIMIT 1");
	}
	
	function CheckScript($script)
	{
		if (file_exists(INCLUDES . 'cron_scripts' . DS . $script))
		{
			return true;
		}
		
		return false;
	}
	
	function GetNextExec($jobId)
	{
		$query = dbquery("SELECT last_exec,exec_every FROM site_cron WHERE id = '" . $jobId . "' LIMIT 1");
		
		if (mysql_num_rows($query) == 1)
		{
			$data = mysql_fetch_assoc($query);
						
			return $data['last_exec'] + $data['exec_every'];		
		}
		
		return -1;
	}
}

?>