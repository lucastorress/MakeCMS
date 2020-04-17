<body id="client" class="flashclient"> 
 
<script type="text/javascript"> 
var habboDefaultClientPopupUrl = "%www%/client";
</script> 

<noscript> 
    <meta http-equiv="refresh" content="0;url=%www%/client/nojs" /> 
</noscript>

<script type="text/javascript"> 
    FlashExternalInterface.loginLogEnabled = true;
    
    FlashExternalInterface.logLoginStep("web.view.start");
    
    if (top == self) {
        FlashHabboClient.cacheCheck();
    }
    var flashvars = {
            "client.allow.cross.domain" : "1", 
            "client.notify.cross.domain" : "0", 
            "connection.info.host" : "127.0.0.1", 
            "connection.info.port" : "30004", 
            "site.url" : "%www%", 
            "url.prefix" : "%www%", 
            "client.reload.url" : "%www%/account/reauthenticate?page=/flash_client", 
            "client.fatal.error.url" : "%www%/flash_client_error", 
            "client.connection.failed.url" : "%www%/client_connection_failed", 
            "external.hash" : "", 
            "external.variables.txt" : "http://dcr.host.portal-habbo.com.br/v_host/r63/gamedata/external_variables", 
            "external.texts.txt" : "http://dcr.host.portal-habbo.com.br/v_host/r63/gamedata/external_flash_texts_br", 
            "use.sso.ticket" : "1",
<?php

if ($forwardType > 0)
{
	echo '            "forward.type" : "' . $forwardType . '",' . LB;
	echo '            "forward.id" : "' . $forwardId . '",' . LB;
}

?>
            "sso.ticket" : "%sso_ticket%", 
            "processlog.enabled" : "0", 
            "account_id" : "0", 
            "client.starting" : "Aquarde o Habbo esta carregando...", 
            "flash.client.url" : "%flash_client_url%", 
            "user.hash" : "", 
            "facebook.user" : "0", 
            "has.identity" : "0", 
            "flash.client.origin" : "popup" 
    };
    var params = {
        "base" : "http://dcr.host.portal-habbo.com.br/v_host/r63/gordon/RELEASE63-30321-30315-201011261026_5c1cea64af7b6d2573b0d9936b1fa1ad/",
        "allowScriptAccess" : "always",
        "menu" : "false"                
    };
    
    if (!(HabbletLoader.needsFlashKbWorkaround())) {
    	params["wmode"] = "opaque";
    }
    
    var clientUrl = "http://dcr.host.portal-habbo.com.br/v_host/r63/gordon/RELEASE63-30321-30315-201011261026_5c1cea64af7b6d2573b0d9936b1fa1ad/Habbo10.swf";
    try {
        if (swfobject.getFlashPlayerVersion().major <= 9) { 
            clientUrl = "http://dcr.host.portal-habbo.com.br/v_host/r63/gordon/RELEASE63-30321-30315-201011261026_5c1cea64af7b6d2573b0d9936b1fa1ad/Habbo.swf"; 
        }
    } catch(e) {}
    swfobject.embedSWF(clientUrl, "flash-container", "100%", "100%", "9.0.115", "http://images.habbo.com/habboweb/%web_build%/web-gallery/flash/expressInstall.swf", flashvars, params);
</script> 
 
<div id="overlay"></div> 
<div id="client-ui" > 
    <div id="flash-wrapper"> 
    <div id="flash-container"> 
        <div id="content" style="width: 400px; margin: 20px auto 0 auto; display: none"> 
<div class="cbb clearfix"> 
    <h2 class="title">Por favor instale o Adobe Flash Player.</h2> 
    <div class="box-content"> 
            <p>Você pode instalar e baixar o Adobe Flash Player aqui: <a href="http://get.adobe.com/flashplayer/">Instale o flash player</a>. Mais instruções para a instalação podem ser encontrados aqui: <a href="http://www.adobe.com/products/flashplayer/productinfo/instructions/">Mais informações</a></p> 
            <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/images/client/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p> 
    </div> 
</div> 
        </div> 
        <script type="text/javascript"> 
            $('content').show();
        </script> 
        <noscript> 
            <div style="width: 400px; margin: 20px auto 0 auto; text-align: center"> 
                <p>Se você não for redirecionado automaticamente, por favor <a href="/client/nojs">clique aqui</a></p> 
            </div> 
        </noscript> 
    </div> 
    </div> 
	<div id="content" class="client-content"></div>            
</div> 
    <div style="display: none"> 
<div id="habboCountUpdateTarget"> 
%hotel_status%
</div> 
	<script language="JavaScript" type="text/javascript"> 
		setTimeout(function() {
			HabboCounter.init(600);
		}, 20000);
	</script> 
    </div> 
    <script type="text/javascript"> 
        RightClick.init("flash-wrapper", "flash-container");
    </script> 
 
</body> 
</html>