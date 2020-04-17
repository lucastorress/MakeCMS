<?php
/*=======================================================================
| UberCMS - Advanced Website and Content Management System for uberEmu
| #######################################################################
| Copyright (c) 2010, Roy 'Meth0d' and updates by Matthew 'MDK'
| http://www.meth0d.org & http://www.sulake.biz
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

$rlname = $users->GetUserVar(USER_ID, 'real_name');
if (empty($rlname))
{
	?>
	<style>
		.jjpoverly .box{
			position: relative;
			top: 10px;
			left: 0px;
			width: 500px;
			height: 250px;
			background: url(/images/overly/box.png) top center no-repeat;
			text-align: left;
			color: white;
			z-index: 9999
		}
			.jjpoverly .box .text{ padding: 5px; }
	</style>
	<script src="https://github.com/kvz/phpjs/raw/master/functions/filesystem/file_get_contents.js" type="text/javascript" language="javascript"></script>
	<script>
		function changerlname(name)
		{
			var succes = file_get_contents("%www%/changeRLname/"+name+"/code/139742685");
			if (succes == "true")
			{
				document.getElementById('jjpoverly').style.display = "none";
				document.getElementById('name').innerHTML = name;
			}
			else
				alert("Seu nome não é alterado.");
		}
	</script>
	
	<div class="jjpoverly" id="jjpoverly" style="display: block;"><center> 
			<div class="box"><div class="text">
				<center><img src="/images/logo.png"></center> 
				<br><br> <div style="padding:2px 5px;background:black;font-size:100%;margin-top:4px;color:white"><b>
				Vemos que o seu nome verdadeiro ainda não está completado.<br>
				<br>
				Por favor, complete o que se pede abaixo.<br>
				<br>
				Obrigado por sua cooperação.<br>
				<br> 
				Name: <input type="text" id="rlname" value=""/>
				<a href="javascript:changerlname(document.getElementById('rlname').value);"><span>Done</span></a><br>
				<span style="font-size: 10px; color: darkred;">Depois de clicar em 'Done', não há nenhuma maneira de mudanças ele!</span><br> 
				<br> 
				<br>
			</div></div> </div>
		</center></div> 
	
	<?php
}


?>