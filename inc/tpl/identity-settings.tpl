<body id="embedpage"> 
<div id="overlay"></div> 


<div id="container"> 
 
    <div class="settings-container clearfix">

        <h1>Ajustes de Conta</h1>

        <div id="back-link">

        <a href="%www%/identity/avatars">Meus Habbos</a> &raquo; Ajustes de Conta  

        </div>

        

        <div style="padding: 0 10px">



        <h3>E-mail:</h3>

        <div class="opt-email">

            <span><?php echo $_SESSION['jjp']['login']['email']; ?></span>

            <!--<a id="manage-email" class="new-button" href="%www%/identity/email"><b>Mudar meu email</b><i></i></a>-->

        </div>

        <br clear="all"/>



        <h3>Utilize para conectar:</h3>

        <p>Aqui está uma lista de serviços da web que você usa para se conectar. Por enquanto não temos nenhuma disponivel.</p>

        <div class="opt-auth-providers clearfix settings-auth" style="float: none; width: auto">        

                <p>

                	<img src="../images/id.png" style="vertical-align: middle" title="habbo"/>

                	<?php echo $_SESSION['jjp']['login']['email']; ?>

		 			<span class="last-access-time">

					    A última vez que usou: *****

					</span>

                </p>

        <p>

        </p>

        </div>

        <br clear="all"/>

                

        <h3>Sua Senha:</h3>
				<?php if (isset($_GET['passwordChanged'])) { ?><p class="confirmation">Sua senha foi alterada corretamente!</p><?php } ?>
        <div class="opt-password">

            <span>**************</span>

            <a id="manage-password" class="new-button" href="%www%/identity/password"><b>Alterar</b><i></i></a>

        </div>



        </div>

    </div>

    <div class="settings-container-bottom">
   
   </div>