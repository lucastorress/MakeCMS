<div> 
<div class="content"> 
<div class="habblet-container" style="float:left; width:210px;"> 
<div class="cbb settings"> 
 
<h2 class="title">Preferências</h2>
<div class="box-content"> 
            <div id="settingsNavigation"> 
            <ul> 
		<a href="change_password.php">Trocar Senha</a><br>
		<a href="change_email.php">Trocar E-mail<br>
		<a href="detalhes.php">Meus Dados<br>
		<a href="identity/avatars">%hotelName% ID</a>
            </ul> 
            </div> 
</div></div> 

<?php if (!$users->HasClub(USER_ID)) { ?>
    <div class="cbb habboclub-tryout"> 
        <h2 class="title">Stage Club !</h2>
        <div class="box-content"> 
            <div class="habboclub-banner-container habboclub-clothes-banner"></div> 
            <p class="habboclub-header">Habbo Club foi feito para você ! Nenhum zé-mané será admitido dentro da nossa sociedade, participe agora !</p>
            <p class="habboclub-link"><a href="%www%/credits/uberclub">Saiba mais &gt;&gt;</a></p>
        </div> 
    </div>
<?php } ?>
	
</div> 
