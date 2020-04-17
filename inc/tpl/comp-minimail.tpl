<div class="habblet-container minimail" id="mail">		
						<div class="cbb clearfix dark blue ">
	
							<h2 class="title">Minhas Mensagens
							</h2> 
						<div id="minimail"> 
    <div class="minimail-contents"> 
	<?php include('minimail-tabcontent.tpl'); ?>
	</div> 
	<div id="message-compose-wait"></div> 
    <form style="display: none" id="message-compose"> 
        <div>Para</div>
        <div id="message-recipients-container" class="input-text" style="width: 426px; margin-bottom: 1em"> 
        	<input type="text" value="" id="message-recipients" /> 
        	<div class="autocomplete" id="message-recipients-auto"> 
        		<div class="default" style="display: none;">Escreva o nome do seu amigo</div>
        		<ul class="feed" style="display: none;"></ul> 
        	</div> 
        </div> 
        <div>Assunto<br/>
        <input type="text" style="margin: 5px 0" id="message-subject" class="message-text" maxlength="100" tabindex="2" /> 
        </div> 
        <div>Mensagem<br/>
        <textarea style="margin: 5px 0" rows="5" cols="10" id="message-body" class="message-text" tabindex="3"></textarea> 
        </div> 
        <div class="new-buttons clearfix"> 
            <a href="#" class="new-button preview"><b>Previsualizar</b><i></i></a>
            <a href="#" class="new-button send"><b>Enviar</b><i></i></a>
        </div> 
    </form>	
</div> 
<script type="text/javascript"> 
	L10N.put("minimail.compose", "Compor").put("minimail.cancel", "Cancelar")
		.put("bbcode.colors.red", "Vermelho").put("bbcode.colors.orange", "Laranja")
    	.put("bbcode.colors.yellow", "Amarelo").put("bbcode.colors.green", "Verde")
    	.put("bbcode.colors.cyan", "Azul escuro").put("bbcode.colors.blue", "Azul")
    	.put("bbcode.colors.gray", "Cinza").put("bbcode.colors.black", "Preto")
    	.put("minimail.empty_body.confirm", "Tem certeza que quer enviar essa mensagem com o corpo dela vazio ?")
    	.put("bbcode.colors.label", "Cores").put("linktool.find.label", " ")
    	.put("linktool.scope.habbos", "Stage").put("linktool.scope.rooms", "Quarto")
    	.put("linktool.scope.groups", "Group").put("minimail.report.title", "Reportar mensagens para o Moderador");
 
    L10N.put("date.pretty.just_now", "Fresquinha !");
    L10N.put("date.pretty.one_minute_ago", "1 minuto atrás");
    L10N.put("date.pretty.minutes_ago", "{0} minutos atrás");
    L10N.put("date.pretty.one_hour_ago", "1 hora atrás");
    L10N.put("date.pretty.hours_ago", "{0} horas atrás");
    L10N.put("date.pretty.yesterday", "Ontem");
    L10N.put("date.pretty.days_ago", "{0} dias atrás");
    L10N.put("date.pretty.one_week_ago", "1 semana atrás");
    L10N.put("date.pretty.weeks_ago", "{0} semanas atrás");
	new MiniMail({ pageSize: 10, 
	   total: 0, 
	   friendCount: 3, 
	   maxRecipients: 50, 
	   messageMaxLength: 20, 
	   bodyMaxLength: 4096,
	   secondLevel: false});
</script> 
	
						
							
					</div> 
				</div> 
				<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script> 
