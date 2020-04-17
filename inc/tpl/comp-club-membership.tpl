<div class="habblet-container ">		
						<div class="cbb clearfix hcred "> 
	
							<h2 class="title">Minha sociedade
							</h2> 
							
<?php if (LOGGED_IN) { ?>
						<script src="http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/habboclub.js" type="text/javascript"></script> 
<div id="hc-habblet"> 
    <div id="hc-membership-info" class="box-content"> 
<?php

$clubDays = $users->GetClubDays(USER_ID);

if ($clubDays <= 0)
{
	echo '<p>Você não é membro da sociedade !</p>';
}
else
{
	echo '<p>Você é membro da sociedade !</p>';
	echo '<p>Atualmente, você tem <b>' . $clubDays . '</b> dias no %hotelName% Club</p>';
}

?>
    </div> 
    <div id="hc-buy-container" class="box-content">
		<div id="hc-buy-buttons" class="hc-buy-buttons rounded rounded-hcred">
		<?php if ($users->GetUserVar(USER_ID, 'credits') < 200) { ?>
        
            <form class="subscribe-form" method="post"> 
                <input type="hidden" id="settings-figure" name="figureData" value=""> 
                <input type="hidden" id="settings-gender" name="newGender" value=""> 
                <table width="97%" style="text-align: center;"> 
                  <p class="credits-notice">Para entrar nessa sociedade, você precisa:</p>
                  <p class="credits-notice">Para iniciar a sociedade, você precisa de 20 %hotelName% Moedas.</p>
                  <a class="new-button fill" href="%www%/credits"><b>Veja a página de %hotelName% Moedas</b><i></i></a>
                </table> 
            </form> 
			
		<?php } else { ?>
		<p>Se você quer OBTER a sociedade, por favor, entre no hotel e disfrute essa oportunidade !</p>
		<?php } ?>
		</div>
    </div> 
</div> 
<?php } else { ?>
<div id="hc-habblet" class='box-content'> 
Por favor, para obter as informações do %hotelName% Club, entre agora em nosso site : <a href="%www%/"> Clique aqui </a>
</div> 
<?php } ?>
	
						
					</div> 
				</div> 
				<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script> 
