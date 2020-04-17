<div class="habblet-container" style="float:left; width: 560px;"> 
<div class="cbb clearfix settings"> 
 
<h2 class="title">Troca de Senha</h2> 
<div class="box-content"> 

<?php if ($updateResult == 1) { ?>
	<div class="rounded rounded-green">
		Sucesso ! Preferências alteradas com sucesso !<br />
	</div>
	<div>&nbsp;</div>
<?php } ?>

<?php if ($updateResult == 2) { ?>
	<div class="rounded rounded-red">
		Erro ! Espaços em branco !<br />
	</div>
	<div>&nbsp;</div>
<?php } ?>

Troque a sua senha com segurança. Fique seguro de que ninguém esteja tem mandando fazer isto.

<br><br>

<form method="post" action="">
<table>
<tr>
<td>Senha atual <?php if ($error == 1) { ?> <span style="color:red; font-size:10px;">* Senha inválida.</span> <?php } ?></td>
</tr>
<tr>
<td><input type="password" name="cpassword"></td>
</tr>
<tr>
<td><span style="color:#c0bdbd;">Você está consciente de alterar a sua senha.</span><br><br></td>
</tr>
<tr>
<td><br></td>
</tr>

<tr>
<td>Nova senha <?php if (($error == 1) || ($error == 2)) { ?> <span style="color:red; font-size:10px;">* Senha inválida</span> <?php } ?></td>
</tr>
<tr>
<td><input type="password" name="npassword"></td>
</tr>
<tr>
<td><span style="color:#c0bdbd;">Enter com uma <?php echo $min; ?>-<?php echo $max; ?>nova senha.</span><br><br></td>
</tr>

<tr>
<td>Nova senha <?php if (($error == 1) || ($error == 2)) { ?> <span style="color:red; font-size:10px;">* Senha inválida</span> <?php } ?></td>
</tr>
<tr>
<td><input type="password" name="rnpassword"></td>
</tr>
<tr>
<td><span style="color:#c0bdbd;">Entrando com a sua nova senha, você estará ficando mais seguro de ladrões.</span><br><br></td>
</tr>

<tr>
<td><input type="submit" name="Enviar"></td>
</tr>
</table>
</form>
            	
</div> 

</div> 
</div> 