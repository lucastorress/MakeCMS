<div class="habblet-container" style="float:left; width: 560px;"> 
<div class="cbb clearfix settings"> 
 
<h2 class="title">Troque o seu visual</h2>
<div class="box-content"> 
            
<?php if ($updateResult == 1) { ?>
	<div class="rounded rounded-green">
		Preferências da sua conta atualizada com sucesso !<br />
	</div>
	<div>&nbsp;</div>
<?php } ?>
            	
<div id="settings-editor"> 
Você precisa do Adobe Flash Player para mudar o visual do seu Habbo, por favor, faça o download clicando <a target="_blank" href="http://www.adobe.com/go/getflashplayer">aqui</a>.
</div> 
 
<div id="settings-wardrobe" style="display: none"> 
</div> 
 
<div id="settings-hc" style="display: none"> 
	<div class="rounded rounded-hcred clearfix"> 
<a href="/credits/habboclub" id="settings-hc-logo"></a> 
Você selecionou itens que tenha o simbolo do %hotelName% Club <img src="http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/images/habboclub/hc_mini.png" />, eles são para membros exclusivos. Se você quer ser um membro exclusivo, <a href="%www%/credits/uberclub">Entre agora</a> para a sociedade.
	</div> 
</div> 
 
<div id="settings-oldfigure" style="display: none"> 
	<div class="rounded rounded-lightbrown clearfix"> 
Seu personagem tinha roupas ou cores que não estão mais disponíveis. Atualize seu personagem e clique em "Salvar alterações.
	</div> 
</div> 
 
<form method="post" action="%www%/profile" id="settings-form" style="display: none"> 
<input type="hidden" name="tab" value="1" /> 
<input type="hidden" name="__app_key" value="%app_key%" /> 
<input type="hidden" name="figureData" id="settings-figure" value="%figureData%" /> 
<input type="hidden" name="newGender" id="settings-gender" value="%gender%" /> 
<input type="hidden" name="editorState" id="settings-state" value="" /> 
<a href="#" id="settings-submit" class="new-button disabled-button"><b>Salvar alterações</b><i></i></a>
</form> 
 
<script type="text/javascript" language="JavaScript"> 
var swfobj = new SWFObject("http://www.habbo.com/%flash_build%/HabboRegistration.swf", "habboreg", "435", "400", "8");
swfobj.addParam("base", "http://www.habbo.com/%flash_build%/");
swfobj.addParam("wmode", "opaque");
swfobj.addParam("AllowScriptAccess", "always");
swfobj.addVariable("figuredata_url", "http://hotel-us.habbo.com/gamedata/figuredata");
swfobj.addVariable("draworder_url", "http://hotel-us.habbo.com/gamedata/figurepartconfig/draworder");
swfobj.addVariable("localization_url", "http://www.habbo.com/figure/figure_editor_xml");
swfobj.addVariable("habbos_url", "http://www.habbo.com/habblet/xml/promo_habbos");
swfobj.addVariable("figure", "%figureData%");
swfobj.addVariable("gender", "%gender%");
<?php

if ($users->HasClub(USER_ID))
{
	echo 'swfobj.addVariable("userHasClub", "1");' . LB;
	echo 'swfobj.addVariable("showClubSelections", "1");' . LB;	
}

?>
 
 
 
if (deconcept.SWFObjectUtil.getPlayerVersion()["major"] >= 8) {
	swfobj.write("settings-editor");
	$("settings-form").show();
	$("settings-wardrobe").show();
}
</script> 
 
</div> 
 
</div> 
</div> 
</div> 
 
</div> 
    </div> 
