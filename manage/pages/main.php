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

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN)
{
	exit;
}

require_once "top.php";

?>			

<h1>Seja bem vindo ao Painel de Controle do MakeCMS!</h1>

<br />

<p>
	Est� � a p�gina inicial da administra��o. Voc� pode navegar na administra��o clicando nos links que se encontra a esquerda.
</p>

<br />

<p>
	Parab�ns <b><?php if (LOGGED_IN) { echo USER_NAME; } ?></b> ! Voc� � um membro da equipe do Habbo Hotel.
</p>

<br />
<br />

<p>
	
		<center><img src="images/uberb.PNG"></center>

	
</p>

<br />

<p>
		
		<b style="color: green; font-size: 120%;">

			<b><?php if (LOGGED_IN) { echo USER_NAME; } ?></b>, caso voc� tenha alguma proposta para n�s, reclama��es de nossos usu�rios, visite o <a href="/manage/index.php?_cmd=forum">F�rum de discu��es</a>. Crie um t�pico e aguarde por <b>respostas</b> !
		</b>
	
</p>

<br />

<p>
		
		<b style="color: black; font-size: 120%;">

			<?php if (LOGGED_IN) { echo USER_NAME; } ?>, nunca, jamais d� c�digos de Habbo Moedas para:<br><br>-  Novatos<br>- Membros incoerentes <br>- Desconhecidos<br><br>Somente d� moedas para:<br><br>- Membros com saldos negativos<br>- Moedas esgotadas<br>- Vencedor de eventos e promo��es.
		</b>
		
	</a>
</p>

<br /><br />
<center>
<div style="width: 50%; border: 1px dotted; padding: 2px; margin: 0;">

	<h2 style="margin: 0;">
		<center>Contatos
	</h2>

	<div style="padding: 5px;">
	
		<p>
			Caso tenha alguma d�vida, emerg�ncia, bugs, veja os e-mails abaixo:
		</p>
		
		<br />
		
		<h3><a href="mailto:sonhador_br@live.com"><strong>sonhador_br@live.com // Lucas Torres \\</strong><br />Desenvolvedor e Editor da CMS.</a></h3>
		
		<br />
		
		<p>
			Caso tenha problemas, nos contate que iremos ajudar !
		</p>	
		
	</div>

</div></center></center>

<?php

require_once "bottom.php";

?>