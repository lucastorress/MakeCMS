<body id="client" class="background-captcha"> 
<div id="overlay"></div> 
<img src="http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/images/page_loader.gif" style="position:absolute; margin: -1500px;" /> 


<div id="change-password-form" style="display: none;">

    <div id="change-password-form-container" class="clearfix">

        <div id="change-password-form-title" class="bottom-border">Esqueci minha senha!</div>

        <div id="change-password-form-content" style="display: none;">

            <form method="post" action="%www%/account/password/identityResetForm" id="forgotten-pw-form">

                <input type="hidden" name="page" value="%www%/quickregister/captcha?changePwd=true" />

                <span>Digite seu endereço de e-mail:</span>

                <div id="email" class="center bottom-border">

                    <input type="text" id="change-password-email-address" name="emailAddress" value="" class="email-address" maxlength="48"/>

                    <div id="change-password-error-container" class="error" style="display: none;">Digite um endereço de e-mail válido</div>

                </div>

            </form>

            <div class="change-password-buttons">

                <a href="#" id="change-password-cancel-link">Cancelar</a>

                <a href="#" id="change-password-submit-button" class="new-button"><b>Enviar e-mail</b><i></i></a>

            </div>

        </div>

        <div id="change-password-email-sent-notice" style="display: none;">

            <div class="bottom-border">

                <span>Um e-mail contendo um link que você pode personalizar sua senha foi enviado para seu email.</span>

                <div id="email-sent-container"></div>

            </div>

            <div class="change-password-buttons">

                <a href="#" id="change-password-change-link">Voltar</a>

                <a href="#" id="change-password-success-button" class="new-button"><b>Fechar</b><i></i></a>

            </div>

        </div>

    </div>

    <div id="change-password-form-container-bottom"></div>

</div>



<script type="text/javascript">

HabboView.add( function() {

     ChangePassword.init();





});

</script> 
<p class="phishing-warning">Verifique se o endereço web começa com alto %www%/</p>

<div id="stepnumbers">

    <div class="stepdone">Data de nascimento &amp; Sexo</div>

    <div class="stepdone">Detalhes</div>

    <div class="step3focus">Security Check</div>

    <div class="stephabbo"></div>

</div>



<div id="main-container">

		%errors%


    <div id="bubble-container" class="cbb">

        <div id="bubble-content" class="rounded">

             <div id="bubble-title">

                Security Check

            </div>

            <div id="captcha-image-container" style="height: 150px;">

							<form id="captcha-form" method="post" action="%www%/quickregister/captcha_submit" onsubmit="Overlay.show(null,'Laden...');">
							
                %recaptcha_html%

            </div>    

        </div>

    </div>



    <div class="delimiter_smooth">

        <div class="flat">&nbsp;</div>

        <div class="arrow">&nbsp;</div>

        <div class="flat">&nbsp;</div>

    </div>



    <div id="inner-container">

       <div id="recaptcha-input-title">Digite conforme acima.</div>

    </div>



    <div id="select">

        <a href="%www%/quickregister/cancel" id="back-link">Cancelar</a>

        <div class="button">

            <a id="proceed-button" href="#" class="area">Pronto!</a>

            <span class="close"></span>

        </div>

   </div>



    <script type="text/javascript">



        document.observe("dom:loaded", function() {

          if($("proceed-button")) {

                $("proceed-button").observe("click", function(e) {

                    Event.stop(e);

                    Overlay.show(null,'Carregando...');

                    $("captcha-form").submit();

                });



                Event.observe($("back-link"), "click", function() {

                    Overlay.show(null,'Carregando...');

                });                  

            }

            

            $("recaptcha_response_field").focus();

        });

    </script>




</div> 
 
<script type="text/javascript"> 
    HabboView.run();
</script> 
 
</body> 
</html>