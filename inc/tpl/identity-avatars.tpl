<?php
/*=======================================================================
| UberCMS - Advanced Website and Content Management System for uberEmu
| #######################################################################
| Copyright (c) 2010, Roy 'Meth0d' and updates by Matthew 'MDK'
| http://www.meth0d.org & http://www.sulake.biz
| #######################################################################
| This program is free software: you can redistribute it and/or modify
| it under the terms of the GNU General Public License as published by
| the Free Software Foundation, either version 3 of the License, or
| (at your option) any later version.
| #######################################################################
| This program is distributed in the hope that it will be useful,
| but WITHOUT ANY WARRANTY; without even the implied warranty of
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
| GNU General Public License for more details.
\======================================================================*/
?>

<body id="embedpage"> 
<div id="overlay"></div> 

<div id="container"> 
 
    <div id="select-avatar">

	<div class="pick-avatar-container clearfix">

        <div class="title">

            <span class="habblet-close"></span>

            <h1>Escolha um %hotelName%</h1>

        </div>

		<div id="content">

            <div id="user-info">

                  <img src="http://static.ak.fbcdn.net/pics/q_silhouette.gif"/>

              <div>

                  <div id="name"><?php echo $_SESSION['jjp']['login']['name']; ?></div>

                  <a href="%www%/account/logout" id="logout">Sair</a>

                  <a href="%www%/identity/settings" id="manage-account">Ajustes de Conta</a>

              </div>



            </div>
            
            %errors%
            
						<?php
							
							$result = dbquery("SELECT `id`,`username`,`last_online`,`look`,`password` FROM `users` WHERE `mail` = '".$_SESSION['jjp']['login']['email']."'");
							
							$i = 0;
							while ($row = mysql_fetch_array($result, MYSQL_NUM))
							{
								
						?>
            <div id="first-avatar">

                <img src="http://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $row[3]; ?>" width="64" height="110"/>

                <div id="first-avatar-info">

                    <div class="first-avatar-name"><?php echo $row[1]; ?></div>

                    <div class="first-avatar-lastonline">Última Visita: <span><?php echo substr($datum = $row[2], 0, strpos($datum, ' ')); ?></span></div>

										<?php if ($row[4] <> $_SESSION['UBER_USER_H'])
											echo "<div id='first-avatar-play-link' style='color: darkred;'>Você não pode jogar com este Habbo.</a></div>";
										else
										{ ?>
										<a id="first-avatar-play-link" href="%www%/identity/useOrCreateAvatar/<?php echo $row[0]; ?>">

                        <div class="play-button-container">

                            <div class="play-button"><div class="play-text">Jogar</div></div>

                            <div class="play-button-end"></div>

                        </div>

                  </a><?php } ?>

                </div>

            </div>
							
						<?php
								$i++;
							}
						
							$over = 10 - $i;
							if ($over <> 0)
								echo '<div id="link-new-avatar"><a class="new-button" href="'.WWW.'/identity/add_avatar"><b>Criar %hotelName%</b><i></i></a></div>';

            	echo '<p style="margin: 5px 10px">Pode criar '.$over.' %hotelName%s.</p>';
            
            ?>

            <div class="other-avatars">

            </div>

        </div>

    </div>

    <div class="pick-avatar-container-bottom"></div>

  </div> 