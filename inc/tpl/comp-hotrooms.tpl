<?php

$eo = 'even';

function GenerateRoomOccupancy($usersNow, $usersMax)
{
	$num = 1;
	$percentage = intval(($usersNow / $usersMax) * 100);

	if ($percentage <= 0)
	{
		$num = 1;
	}
	else if ($percentage < 35)
	{
		$num = 2;
	}
	else if ($percentage < 75)
	{
		$num = 3;
	}
	else if ($percentage < 100)
	{
		$num = 4;
	}
	else if ($percentage >= 100)
	{
		$num = 5;
	}
	
	return 'room-occupancy-' . $num;
}

?>
<div class="habblet-container ">		
<div class="cbb clearfix red "> 

<h2 class="title">Quartos Recomendados</h2> 

<style type="text/css">
.room-occupancy-1 { background-image: url('http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/images/rooms/room_icon_1.gif') !important; }
.room-occupancy-2 { background-image: url('http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/images/rooms/room_icon_2.gif') !important; }
.room-occupancy-3 { background-image: url('http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/images/rooms/room_icon_3.gif') !important; }
.room-occupancy-4 { background-image: url('http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/images/rooms/room_icon_4.gif') !important; }
.room-occupancy-5 { background-image: url('http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/images/rooms/room_icon_5.gif') !important; }
</style>

<div id="rooms-habblet-list-container-h124" class="recommendedrooms-lite-habblet-list-container"> 
<ul class="habblet-list"> 

<?php

$get = dbquery("SELECT * FROM rooms WHERE roomtype = 'private' ORDER BY users_now DESC LIMIT 5");

while ($room = mysql_fetch_assoc($get))
{	
	if ($eo == 'even')
	{
		$eo = 'odd';
	}
	else
	{
		$eo = 'even';
	}

	echo '<li class="' . $eo . '"> 
	<span class="clearfix enter-room-link ' . GenerateRoomOccupancy($room['users_now'], $room['users_max']) . '" title="Ga erheen" roomid="' . $room['id'] . '"> 
	<span class="room-enter">Enter room</span> 
	<span class="room-name">' . clean($room['caption']) . '</span> 
	<span class="room-description">' . clean($room['description']) . '</span>              
	<span class="room-owner">Owner: <a href="%www%/home/' . uberUsers::name2id($room['owner']) . '/id">' . clean($room['owner']) . '</a></span> 
	</span> 
	</li>';
}

?>

<div id="room-more-data-h124" style="display: none"> 
<ul class="habblet-list room-more-data"> 

<?php

$get = dbquery("SELECT * FROM rooms WHERE roomtype = 'private' ORDER BY users_now DESC LIMIT 5,10");

while ($room = mysql_fetch_assoc($get))
{	
	if ($eo == 'even')
	{
		$eo = 'odd';
	}
	else
	{
		$eo = 'even';
	}

	echo '<li class="' . $eo . '"> 
	<span class="clearfix enter-room-link ' . GenerateRoomOccupancy($room['users_now'], $room['users_max']) . '" title="Ga erheen" roomid="' . $room['id'] . '"> 
	<span class="room-enter">Enter room</span> 
	<span class="room-name">' . clean($room['caption']) . '</span> 
	<span class="room-description">' . clean($room['description']) . '</span>              
	<span class="room-owner">Owner: <a href="%www%/home/' . uberUsers::name2id($room['owner']) . '/id">' . clean($room['owner']) . '</a></span> 
	</span> 
	</li>';
}

?>

</ul> 
</div> 

<div class="clearfix"> 
<a href="#" class="room-toggle-more-data" id="room-toggle-more-data-h124">Toon meer kamers</a> 
</div> 

</div> 

<script type="text/javascript"> 
L10N.put("show.more", "Show more rooms");
L10N.put("show.less", "Show less rooms");
var roomListHabblet_h124 = new RoomListHabblet("rooms-habblet-list-container-h124", "room-toggle-more-data-h124", "room-more-data-h124");
</script>

</div> 
</div> 
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>