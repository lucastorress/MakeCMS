<div class="habblet-container">		
<div class="cbb clearfix blue"> 

<h2 class="title"><b>Meus Emblemas</b></h2>

<div class="box-content">
<center><?php

    $getBadges = dbquery("SELECT * FROM user_badges WHERE user_id = '" . USER_ID . "' AND badge_slot >= 1 ORDER BY badge_slot DESC LIMIT 5");
		
?>

<div id="badge-back">
    <ul class="badge-back"><br>
<?php
    while($b = mysql_fetch_assoc($getBadges)){
                echo '&nbsp;&nbsp;<img src="http://images.habbo.com/c_images/album1584/' . $b['badge_id'] . '.gif"> &nbsp; &nbsp;';
}
    ?>

    </div> 
    </center>

</div>	
</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>