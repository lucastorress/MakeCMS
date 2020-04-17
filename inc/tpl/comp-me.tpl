				<div class="habblet-container ">		
	
						<div id="new-personal-info" style="background-image:url(%www%/images/htlview.png)"> 

  <div class="enter-hotel-btn"> 
        <div class="open enter-btn"> 
                <a href="%www%/client" target="uberClientWnd" onclick="HabboClient.openOrFocus(this); return false;">Entrar no Habbo<i></i></a>
            <b></b> 
        </div> 
    </div> 
    
 
	<div id="habbo-plate"> 
		<a href="%www%/profile"> 
				<img alt="%habboName%" src="http://www.habbo.com/habbo-imaging/avatarimage?figure=%look%&action=crr=667&direction=3&head_direction=3&gesture=sml&size=l" />
		</a> 
	</div> 
 
	<div id="habbo-info"> 
		<div id="motto-container" class="clearfix">			
			<strong>%habboName%:</strong> 
			<div>
			<?php
			
			if (strlen($motto) == 0)
			{
				$motto = "Qual seu pensamento de hoje?";
			}
			
			echo '<span title="' . $motto . '">' . $motto . '</span>';
			echo '<p style="display: none"><input type="text" maxlength="40" name="motto" value="' . $motto . '"/></p>';
				
			?>
			
				
			</div> 
		</div> 
		<div id="motto-links" style="display: none"><a href="#" id="motto-cancel">Cancelar</a></div>
	</div> 
	
	<ul id="link-bar" class="clearfix"> 
		<li class="change-looks"><a href="%www%/client">Mudar de Ropa &raquo;</a></li>
		<li class="credits"> 
			<a href="%www%/credits">%creditsBalance%</a> Moedas
		</li>		
		    <li class="activitypoints"> 
			    <a href="%www%/credits/pixels">%pixelsBalance%</a> Pixels
		    </li> 
	</ul> 
	
	<div id="habbo-feed"> 
		<ul id="feed-items">  
		
	        <li class="small" id="feed-lastlogin"> 
                <center>Sua última visita foi em:
                %lastSignedIn%</center>
	        </li>
	        <li class="small" id="Make-cms" style="background-image: url('%www%/images/positivo.gif') !important; padding-left: 65px;">  
                <center>Você já recebeu %respect1% respeito(s)</center>
	        </li>
	        <li class="small" id="Make-cms" style="background-image: url('%www%/images/accept.png') !important; padding-left: 65px;"> 
                <center>Rank Atual:
                <b>%rank%</b></center>
	        </li>
	        <li class="small" id="Make-cms" style="background-image: url('%www%/images/online.png') !important; padding-left: 65px;">  
                <center>
                Você é o(a) <b>%id%</b>° usuário(a) a se cadastrar no hotel</center>
	        </li>
		</ul> 
	</div> 
	<p class="last"></p> 
</div> 
 
<script type="text/javascript"> 
	HabboView.add(function() {
		L10N.put("personal_info.motto_editor.spamming", "Don\'t spam me, bro!");
		PersonalInfo.init("");
	});
</script> 
	
						
							
					
				</div> 
				<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>
