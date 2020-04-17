	<ul class="message-headers">
            <li class="header-report"><a href="#" class="report" title="Reportar se a mensagem for ofensiva"></a></li>
		<li><b>Assunto:</b> %subject%</li>
		<li><b>Para:</b> %from%</li>
		<?php if (!$sent) { ?><li><b>De:</b> %to%</li><?php } ?>
	</ul>
    <div class="body-text">%body-text%</div>
    <div class="reply-controls">
        <div>
            <div class="new-buttons clearfix">
                <?php if (!$trashed) { ?><!--<a href="#" class="related-messages" id="rel-%message_id%" title="Show full conversation"></a>--><?php } ?>
				<?php if ($trashed) { ?><a href="#" class="new-button undelete"><b>Não deletar</b><i></i></a><?php } ?>
            	<a href="#" class="new-button red-button delete"><b>Deletar</b><i></i></a>
                <?php if (!$trashed && !$sent) { ?><a href="#" class="new-button reply"><b>Responder</b><i></i></a><?php } ?>
            </div>
        </div>
        <div style="display: none">
	        <textarea rows="5" cols="10" class="message-text"></textarea><br />
	        <div class="new-buttons clearfix">
    	        <a href="#" class="new-button cancel-reply"><b>Cancelar</b><i></i></a>
    	        <a href="#" class="new-button preview"><b>Previsualizar</b><i></i></a>
                <a href="#" class="new-button send-reply"><b>Enviar</b><i></i></a>
	        </div>
        </div>
    </div>
