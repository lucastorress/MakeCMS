<body id="client" class="background-agegate"> 
<div id="overlay"></div> 
<img src="http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/images/page_loader.gif" style="position:absolute; margin: -1500px;" /> 


<div id="change-password-form" style="display: none;">

    <div id="change-password-form-container" class="clearfix">

        <div id="change-password-form-title" class="bottom-border">Wachtwoord vergeten?</div>

        <div id="change-password-form-content" style="display: none;">

            <form method="post" action="%www%/account/password/identityResetForm" id="forgotten-pw-form">

                <input type="hidden" name="page" value="%www%/quickregister/start?changePwd=true" />

                <span>Digite seu endereço de e-mail:</span>

                <div id="email" class="center bottom-border">

                    <input type="text" id="change-password-email-address" name="emailAddress" value="" class="email-address" maxlength="48"/>

                    <div id="change-password-error-container" class="error" style="display: none;">Digite um endereço de e-mail válido</div>

                </div>

            </form>

            <div class="change-password-buttons">

                <a href="#" id="change-password-cancel-link">Annuleren</a>

                <a href="#" id="change-password-submit-button" class="new-button"><b>Verstuur e-mail</b><i></i></a>

            </div>

        </div>

        <div id="change-password-email-sent-notice" style="display: none;">

            <div class="bottom-border">

                <span>Um e-mail contendo um link que você pode personalizar sua senha foi enviado para seu endereço.</span>

                <div id="email-sent-container"></div>

            </div>

            <div class="change-password-buttons">

                <a href="#" id="change-password-change-link">Terug</a>

                <a href="#" id="change-password-success-button" class="new-button"><b>Sluiten</b><i></i></a>

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
<link rel="stylesheet" href="http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/quickregister.css" type="text/css" />
<link rel="stylesheet" href="http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/forcedemaillogin.css" type="text/css" />

 
 
<p class="phishing-warning">Verifique se o endereço web começa com alto %www%/</p> 
<div id="stepnumbers"> 
    <div class="step1focus">Nascimento &amp; Sexo</div> 
    <div class="step2">Detalhes</div> 
    <div class="step3">Security Check</div> 
    <div class="stephabbo"></div> 
</div> 
 
<div id="main-container"> 
 
				%errors% 
 
    <form id="quickregisterform" method="post" action="%www%/quickregister/age_gate_submit"> 
 
        <div id="title"> 
            Nascimento e sexo
        </div> 
 
        <div id="date-selector"> 
            <div id="agegate-notice"><span style="font-size:12px; color: #00ccff;">Por favor insira a sua  <b>real</b> Data de Nascimento</span></div> 
<select name="bean.day" id="bean_day" class="dateselector"><option value="">Data</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select> <select name="bean.month" id="bean_month" class="dateselector"><option value="">Mês</option><option value="1">janeiro</option><option value="2">Fevereiro</option><option value="3">Março</option><option value="4">Abril</option><option value="5">Maio</option><option value="6">Junho</option><option value="7">Julho</option><option value="8">Agosto</option><option value="9">Setembro</option><option value="10">Outubro</option><option value="11">Novembro</option><option value="12">Dezembro</option></select> <select name="bean.year" id="bean_year" class="dateselector"><option value="">Ano</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option><option value="1904">1904</option><option value="1903">1903</option><option value="1902">1902</option><option value="1901">1901</option><option value="1900">1900</option></select>         </div> 
 
        <div class="delimiter_smooth"> 
            <div class="flat">&nbsp;</div> 
            <div class="arrow">&nbsp;</div> 
            <div class="flat">&nbsp;</div> 
        </div> 
 
        <div id="inner-container"> 
            <div id="gender-selection"> 
                <div class="select_gender boy"> 
                    <div class="silhouette"> 
                        <img src="http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/images/frontpage/silhouette_boy.png"/> 
                    </div> 
                    <div class="select-container"> 
                        <input type="radio" id="radio-button-boy" name="bean.gender" value="male" checked="checked"/> 
                        <label for="radio-button-boy">Homem</label> 
                    </div> 
                </div> 
                <div class="select_gender girl"> 
                    <div class="silhouette"> 
                        <img src="http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/images/frontpage/silhouette_girl.png"/> 
                    </div> 
                    <div class="select-container"> 
                        <input type="radio" id="radio-button-girl" name="bean.gender" value="female" style="float: left;"/> 
                        <label for="radio-button-girl" style="float: left;">Mulher</label> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </form> 
 
    <div id="select"> 
        <a id="back-link" href="%www%/quickregister/cancel">Cancelar</a> 
        <div class="button"> 
            <a id="proceed" href="#" class="area">Continuar</a> 
            <span class="close"></span> 
        </div> 
   </div> 
</div> 
 
<script language="JavaScript" type="text/javascript"> 
    document.observe("dom:loaded", function() {
        Event.observe($("back-link"), "click", function() {
            Overlay.show(null,'Carregando...');
        });        
        Event.observe('proceed', 'click', function(event) {
            Overlay.show(null,'Carregando...');
            $("quickregisterform").submit();
        });
        var boyImg = $$(".select_gender.boy img");
        if (boyImg.length > 0) {
            boyImg[0].observe("click", function() {$("radio-button-boy").checked=true;});
        }
        var girlImg = $$(".select_gender.girl img");
        if (girlImg.length > 0) {
            girlImg[0].observe("click", function() {$("radio-button-girl").checked=true;});
        }
        var dateSelector = $$("#date-selector select");
        if (dateSelector.length > 0) {
            dateSelector[0].focus();
        }
        new Ajax.Request("%www%/quickregister/start_loaded");
    });
</script> 
 
<script type="text/javascript"> 
    HabboView.run();
</script> 
 
</body> 
</html>