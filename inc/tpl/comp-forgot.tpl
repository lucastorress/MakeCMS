<?php

$host="your hostname"; // Host name
$username="your MySQL"; // Mysql username
$password="your password"; // Mysql password
$db_name="your name database"; // Database name


//Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("Impossible de se connecter au serveur");
mysql_select_db("$db_name")or die("Impossible de séléctionner la base de données");

// value sent from form
$email_to=$_POST['email_to'];

// table name
$tbl_name=members;

// retrieve password from table where e-mail = $email_to(mark@phpeasystep.com)
$sql="SELECT password,username FROM users WHERE mail='$email_to'";
$result=mysql_query($sql);

// if found this e-mail address, row must be 1 row
// keep value in variable name "$count"
$count=mysql_num_rows($result);

// compare if $count =1 row
if($count==1){

$rows=mysql_fetch_array($result);

// Le mot de passe est $your_password
$your_password=$rows['password'];

// Affichera le pseudo dans le message
$username=$rows['username'];

// ---------------- SEND MAIL FORM ----------------

// send e-mail to ...
$to=$email_to;

// Your subject
$subject="Ton mot de passe";

// From
$header="from: Hobbou Hotel FR <contact@hobbouhotel.com>";

// Votre message
$messages= "Salut $email_to, \r\n";
$messages.= "Tu as souhaité(e) retrouver ton mot de passe perdu? Eh bien nous te l'avons retrouver\r\n";
$messages.= "Voici tes identifiants pour te connecter \r\n";
$messages.= "Nom Hobbou: $username \r\n";
$messages.= "Mot de Passe: $your_password \r\n";
$messages.= "Nous te conseillons vivement de changer de mot de passe si cela n'est pas déjà fait!\r\n";
$messages.= "Equipe Hobbou\r\n";

// Envoi du message
$sentmail = mail($to,$subject,$messages,$header);

}

// Si le message est envoyé avec succès
if($sentmail){
echo "<i>Nous avons envoyés un email contenant ton mot de passe avec le pseudo correspondant</i>";
}
?>
<head> 
<style type="text/css">
        div.left-column { float: left; width: 48% }
        div.right-column { float: right; width: 47% }
        label { display: block }
        input { width: 98% }
        input.process-button { width: auto; float: right }
        div.box-content { padding: 15px 8px; }
        div.right-column p { color: gray; }
        div.right-column .habbo-id-logo { background: transparent url(%www%/images/Habbo_ID_logo_white.png) no-repeat; padding-top: 2px; height: 48px; width: 170px; float:right; }
        div.divider {background: transparent url(%www%/images/line_gray.png) repeat-y; width: 1px; height: 130px; float:left; margin: 1px 15px 20px;}
    </style>
<link rel="shortcut icon" href="%www%/favicon.ico">

             <div id="process-content">
<div class="cbb clearfix">

    <h2 class="title">Tu as oubli&eacute; ton mot de passe?</h2>
    <div class="box-content">
      <div class="left-column">

        <p>Pas de panique! Laisse-nous tes coordonn&eacute;es ci-dessous et nous t'enverrons un email pour t'indiquer comment g&eacute;n&eacuterer un nouveau mot de passe.</p>

        <div class="clear"></div>

        <form method="post" action="forgot" id="forgottenpw-form">

            <p>
            <label for="forgottenpw-username">Nom %%</label>
            <input type="text" name="username" id="username" value="" />
            </p>

            <p>
            <label for="forgottenpw-email">Adresse email</label>
            <input type="text" name="email_to" id="mail_to" value="" />

            </p>

            <p>
            <input type="submit" value="Demande de mot de passe" name="submit" class="submit process-button" id="forgottenpw-submit" />
            </p>
            <input type="hidden" value="default" name="origin" />
        </form>
      </div>
      <div class="divider"></div>

      <div class="right-column">
          <p><b>Qu'est-ce qu'un mot de passe?</b></p>
          <p>Ici tu peux changer le mot de passe associ&eacute; &agrave; un %% en particulier. Ton nom %% et ton adresse email d&eacute;termineront le mot de passe &agrave; changer. Attention: cela ne changera pas ton mot de passe %% ID.</p>
      </div>
    </div>
</div>

<div class="cbb clearfix">
    <h2 class="title">Tu as oubli&eacute; ton mot de passe Facebook, Google ou autre?</h2>

    <div class="box-content">
      <div class="left-column">
        <p>%% ne peut modifier qu'un mot de passe associ&eacute; &agrave; une %% ID. Pour changer de mot de passe sur un autre site (Facebook, Google ou autres) contacte-les directement.</p>
      </div>
      <div class="divider"></div>
      <div class="right-column">
          <p><b>Pourquoi ne puis-je pas changer mon mot de passe Facebook, Goggle ou autre?</b></p>
          <p>%% Hotel n'a pas acc&egrave;s aux mots de passe que tu utilises sur d'autres sites.</p>

      </div>
    </div>
</div>

  <p><a href="%www%/">Retour &agrave; l'accueil &raquo;</a></p>
  <div class="clear"></div>