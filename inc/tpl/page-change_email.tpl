<div class="habblet-container" style="float:left; width: 560px;"> 
<div class="cbb clearfix settings"> 
 
<h2 class="title">Trocar E-mail</h2> 
<div class="box-content"> 

<?php if ($updateResult == 1) { ?>
	<div class="rounded rounded-green">
		Sucesso ! E-mail alterado !<br />
	</div>
	<div>&nbsp;</div>
<?php } ?>

<?php if ($updateResult == 2) { ?>
	<div class="rounded rounded-red">
		Erro! Espa�os em branco !<br />
	</div>
	<div>&nbsp;</div>
<?php } ?>

Se algu�m lhe pediu para mudar essas configura��es, n�o altere ! Ela pode estar te roubando !

<br><br>

<form method="post" action="">
<table>
<tr>
<td>Senha atual <?php if ($error == 1) { ?> <span style="color:red; font-size:10px;">* Senha inv�lida.</span> <?php } ?></td>
</tr>
<tr>
<td><input type="password" name="cpassword"></td>
</tr>
<tr>
<td><span style="color:#c0bdbd;">Para sua seguran�a, entre com uma senha segura e que possa te lembrar facilmente.</span><br><br></td>
</tr>
<tr>
<td><br></td>
</tr>

<tr>
<td>Novo E-mail <?php if (($error == 1) || ($error == 2)) { ?> <span style="color:red; font-size:10px;">* E-mail inv�lido</span> <?php } ?></td>
</tr>
<tr>
<td><input type="email" name="nemail"></td>
</tr>
<tr>
<td><span style="color:#c0bdbd;">Entre com o novo endere�o de e-mail.</span><br><br></td>
</tr>

<tr>
<td>Novo E-mail<?php if (($error == 1) || ($error == 2)) { ?> <span style="color:red; font-size:10px;">* E-mail inv�lido</span> <?php } ?></td>
</tr>
<tr>
<td><input type="email" name="rnemail"></td>
</tr>
<tr>
<td><span style="color:#c0bdbd;">Entre com os dados atuais do seu novo e-mail.</span><br><br></td>
</tr>

<tr>
<td><input type="submit" name="Trocar"></td>
</tr>
</table>
</form>
            	
</div> 

</div> 
</div> 