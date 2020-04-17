<body id="client" class="background-accountdetails-male"> 
<div id="overlay"></div> 
<img src="http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/images/page_loader.gif" style="position:absolute; margin: -1500px;" /> 


<div id="change-password-form" style="display: none;">

    <div id="change-password-form-container" class="clearfix">

        <div id="change-password-form-title" class="bottom-border">Wachtwoord vergeten?</div>

        <div id="change-password-form-content" style="display: none;">

            <form method="post" action="%www%/account/password/identityResetForm" id="forgotten-pw-form">

                <input type="hidden" name="page" value="%www%/quickregister/email_password?changePwd=true" />

                <span>Vul hier je e-mailadres in:</span>

                <div id="email" class="center bottom-border">

                    <input type="text" id="change-password-email-address" name="emailAddress" value="" class="email-address" maxlength="48"/>

                    <div id="change-password-error-container" class="error" style="display: none;">Vul alsjeblieft een werkend e-mailadres in</div>

                </div>

            </form>

            <div class="change-password-buttons">

                <a href="#" id="change-password-cancel-link">Annuleren</a>

                <a href="#" id="change-password-submit-button" class="new-button"><b>Enviar e-mail</b><i></i></a>

            </div>

        </div>

        <div id="change-password-email-sent-notice" style="display: none;">

            <div class="bottom-border">

                <span>Um e-mail contendo um link que você pode personalizar sua senha foi enviado para seu endereço.</span>

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

    <div class="stepdone">Nascimento &amp; Sexo</div>

    <div class="step2focus">Detalhes</div>

    <div class="step3">Security Check</div>

    <div class="stephabbo"></div>

</div>



<div id="main-container">


		%errors%


    <div id="title">

        Seus Dados Habbo

    </div>



    <form method="post" action="%www%/quickregister/email_password_submit" id="quickregister-form">

      <div id="inner-container">

        <div class="inner-content bottom-border">

            <div id="email-notice" class="field-content"><span style="font-size:14px; color: #22b9f1;">Você pode usar o seu e-mail e senha </b> Para logar no %hotelname%  </div>

						<div class="field-content clearfix">

                <div class="left">

                    <div class="label" class="registration-text">%hotelName% Nome:</div>

                    <input type="text" id="email-address" name="bean.name" value="" />

                </div>

                <div class="right">

                    <div class="help">Use esse nome  no <b>hotel</b>!</div>

                </div>

            </div>

            <div class="field-content clearfix">

                <div class="left">

                    <div class="label" class="registration-text">E-mail:</div>

                    <input type="text" id="email-address" name="bean.email" value="" />

                </div>

                <div class="right">

                    <div class="help">Você tem esse <b>E-Mail</b> depois necessário </b>para Logar</b>. Então use um endereço real.</div>

                </div>

            </div>



            <div class="field-content clearfix">

                <div class="left">

                    <div class="field">

                        <div class="label" class="registration-text"> Senha:</div>

                        <input type="password" name="bean.password" id="register-password" maxlength="32" value="" />

                    </div>

                    <div class="password-field">

                        <div class="label" class="registration-text">Redigite sua  senha:</div>

                        <input type="password" name="bean.retypedPassword" id="register-password2" maxlength="32" value=""  />

                    </div>



                </div>

                <div class="right">

                    <div class="help">Sua senha deve ter mais de <b>6 Caracters</b> longo e deve conter <b>letras e números</b> .</div>

                </div>

            </div>

        </div>



        <div class="inner-content top-margin">

			<div class="field-content checkbox ">

			  <label>

			    <input type="checkbox" name="bean.termsOfServiceSelection" id="terms" value="true" class="checkbox-field"/>

			    Eu entendo e concordo com os <a href="#" target="_blank" onclick="window.open('%www%/papers/termsAndConditions'); return false;">Termos</a>

			  </label>

			</div>            





        </div>

      </div>

    </form>





    <div id="select">

        <div class="button">

            <a id="proceed-button" href="#" class="area">Continuar</a>

            <span class="close"></span>

        </div>

        <a href="%www%/quickregister/cancel" id="back-link">Cancelar</a>

   </div>

</div>



<script type="text/javascript">

    document.observe("dom:loaded", function() {

        Event.observe($("back-link"), "click", function() {

            Overlay.show(null,'Carregando...');

        });

        Event.observe($("proceed-button"), "click", function() {

            Overlay.show(null,'Carregando...');            

            $("quickregister-form").submit();

        });

            $("email-address").focus();

    });

</script>  
 
<script type="text/javascript"> 
    HabboView.run();
</script> 
 
</body> 
</html>