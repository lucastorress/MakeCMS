<div class="habblet-container">		
<div class="cbb clearfix activehomes"> 
<h2 class="title">
 Habbos Sortidos - Clique e saiba mais !
</h2> 

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
											echo "<div id='first-avatar-play-link' style='color: darkred;'>Você não pode brincar com este Stage.</a></div>";
										else
										{ ?>
										<a id="first-avatar-play-link" href="%www%/identity/useOrCreateAvatar/<?php echo $row[0]; ?>">

                            <div class="play-button-container">

                            <div class="play-button"><div class="play-text"><font color="black">Jogar</font></div></div>

                            <div class="play-button-end"></div>


                        </div>

                  </a><?php } ?>

                </div>

            </div>