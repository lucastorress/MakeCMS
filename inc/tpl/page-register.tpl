



<body id="register"> 
<div id="overlay"></div> 
<div id="container" class="phase-0" style="margin-top: 10px;"> 
    <p class="phishing-warning">Certifique-se que o registro começa em %www%.</p>
	<div class="register-container clearfix"> 
	    <div class="register-header">Registro</div>
	  <div id="register-content"> 
	  
        <div id="subheader">Crie agora seu %hotelName% !
</div> 
 
<div class="register-container-bottom-end register-content clearfix"> 
<div id="auth-providers" class="auth-providers"> 
    <ul> 
        <li class="facebook"> 
            <a href="#" onclick="" class="fbconnect_login_button">Facebook</a> 
        </li> 
        <li class="twitter"> 
            <a href="#"></a> 
<form method="post" action="" target="rpx_login"> 
    <input type="submit" value="twitter"/> 
</form> 
        </li> 
        <li class="google"> 
            <a href="#">Google</a> 
<form method="post" action="" target="rpx_login"> 
    <input type="hidden" value="https://www.google.com/accounts/o8/id" name="openid_identifier" id="openid_identifier"/> 
    <input type="submit" value="google"/> 
</form> 
        </li> 
        <li class="hyves"> 
            <a href="#">Hyves</a> 
<form method="post" action="" target="rpx_login"> 
    <input type="hidden" value="http://hyves.net/" name="openid_identifier" id="openid_identifier"/> 
    <input type="submit" value="hyves"/> 
</form> 
        </li> 
        <li class="myspace"> 
            <a href="#">My Space</a> 
<form method="post" action="" target="rpx_login"> 
    <input type="submit" value="myspace"/> 
</form> 
        </li> 
        <li class="windowslive"> 
            <a href="#">Windows Live</a> 
<form method="post" action="" target="rpx_login"> 
    <input type="submit" value="windowslive"/> 
</form> 
        </li> 
        <li class="yahoo"> 
            <a href="#">Yahoo</a> 
<form method="post" action="" target="rpx_login"> 
    <input type="hidden" value="http://yahoo.com" name="openid_identifier" id="openid_identifier"/> 
    <input type="submit" value="yahoo"/> 
</form> 
        </li> 
    </ul> 
    <p>Outras opções do registro.</p>
</div> 
<div id="register-page" style="clear: left" class="phase-0 clearfix"> 
	<p>Registre-se gratuitamente no %hotelName% Hotel.</p>
	<div class="phase-0"> 
		<form action="/register_submit" method="post" id="phase-0-form"> 
            
			<div id="error-messages-container"> 
			%error-messages-holder%
			</div> 
			
			<div id="name-field-container"> 
                <div class="field field-habbo-name"> 
                  <label for="habbo-name"><b>Usuário:</b></label>
                  <input type="text" id="habbo-name" size="32" value="%post-name%" name="bean.avatarName" class="text-field" maxlength="32"/> 
                  <a href="#" class="new-button" id="check-name-btn"><b>Verificar</b><i></i></a>
                  <input type="submit" name="checkNameOnly" id="check-name" value="Check"/> 
                    <div id="name-suggestions"> 
                    </div>              
                  <p class="help">Seu nome pode ter letras maiúsculas e minúsculas.</p>
                </div> 
			</div> 
			<div class="field field-password"> 
			  <label for="password"><b>Senha:</b></label>
			  <input type="password" id="password" size="35" name="bean.password" value="%post-pass%" class="password-field" maxlength="32"/> 
			  <p class="help">Sua senha não pode ter menos de 6 caracteres.</p>
			</div> 
			
			<div class="field field-password2"> 
			  <label for="password2"><b>Repita sua senha:</b></label>
			  <input type="password" id="password2" size="35" name="bean.retypedPassword" value="" class="password-field" maxlength="32"/> 
			  <p class="help">É necessário repetir a senha para que não haja fraudes.</p>
			</div> 
			
			<div class="field field-email"> 
			  <label for="email"><b>E-mail:</b></label>
			  <input type="text" id="email" size="35" name="bean.email" value="%post-mail%" class="text-field" maxlength="48"/> 
			  <p class="help">Digite o seu endereço de E-mail.</p>
			</div> 
						
			<div class="field field-birthday"> 
			  <label><b>Data de nascimento:</b></label>
			  <span id="bday-selects">  
<select name="bean.day" id="bean_day" class="dateselector"><option value="">Dia</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select> <select name="bean.month" id="bean_month" class="dateselector"><option value="">Mês</option><option value="1">Janeiro</option><option value="2">Fevereiro</option><option value="3">Março</option><option value="4">Abril</option><option value="5">Maio</option><option value="6">Junho</option><option value="7">Julho</option><option value="8">Agosto</option><option value="9">Setembro</option><option value="10">Outubro</option><option value="11">Novembro</option><option value="12">Dezembro</option></select> <select name="bean.year" id="bean_year" class="dateselector"><option value="">Ano</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option><option value="1904">1904</option><option value="1903">1903</option><option value="1902">1902</option><option value="1901">1901</option><option value="1900">1900</option></select> 			  </span>
			  <p class="help">Digite a data de nascimento para o caso de esquecer a senha.</p>
			</div> 
						
			<div class="field field-parent-email"> 
			  <label for="parent-email">E-mail dos pais:</label>
			  <input type="text" id="parent-email" size="35" name="bean.parentEmail" value="" class="text-field" maxlength="128"/> 
			  <p class="help">Você é menor de 16 anos, por isso requere que esse campo seja preenchido.</p>
			</div> 
			
            <div class="field field-parent-permission"> 
            </div> 
			
			<script>
			var RecaptchaOptions = {
			   theme : 'white'
			};
			</script>
			
			<style type="text/css">
			#recaptcha_response_field
			{
				font-size: 12px !important;
				font-weight: normal !important;
			}
			</style>			
			
			<div class="field field-recaptcha" style="margin-left: -15px;">
			%recaptcha_html%
			</div>
			
			<div class="field field-tos">
			
				<input id="tos" value="accept" type="checkbox" id="password" name="bean.tos" %post-tos-check%/>Eu aceito os termos de serviço.</a>.
			
			</div>
 
            <a href="#" class="new-button" id="next-btn"><b>Continuar</b><i></i></a>
            <input type="submit" id="next" value="Criar usuário" /><a href="%www%/register/cancel">Cancelar</a>
 
		</form> 
	
	</div> 
	
</div> 
<script type="text/javascript"> 
    L10N.put("embedded_registration.errors.header", "Opa! Um erro aconteceu durante o seu processo de registro, tente novamente !");
    L10N.put("register.error.password_required", "Senhas não se conferem.");
    L10N.put("register.error.retyped_password_required", "Porfavor, repita a sua senha !");
    L10N.put("register.error.retyped_password_notsame", "As senhas não podem ser reconhecidas, repita ela novamente.");
    L10N.put("register.error.password_length", "A sua senha não contém os caracteres necessários.");
    L10N.put("register.error.password_chars", "Você deve usar apenas letras e números.");
	SimpleRegistration.initRegistrationUI("/");
</script> 
 
        </div> 
    </div> 
    <div class="register-container-bottom"></div> 
