<?php

function GetDescr($level)
{
	switch ($level)
	{
		case 7:

			return '';
			
		case 6:
		
			return '';
			
		case 5:
		
			return '';
			
		case 4:
		
			return '';
			
		case 3:
		
			return '';
	
		default:
		
			return '';
	}
}

$getGroups = dbquery("SELECT id,name FROM ranks WHERE id >= 3 ORDER BY id DESC");

while ($group = mysql_fetch_assoc($getGroups))
{	
	echo '<div class="habblet-container ">		
<div class="cbb clearfix white "> 
<h2 class="title"><span style="float: left;">' . clean($group['name']) . 's</span> <span style="float: right; font-weight: normal; font-size: 75%;">' . GetDescr($group['id']) . '</span></h2>';
	
	$getMembers = dbquery("SELECT id,username,motto,look,online FROM users WHERE rank = '" . $group['id'] . "'");
	
	echo '<div class="box-content">';
	
	if (mysql_num_rows($getMembers) > 0)
	{
		$oe = 1;
		
		while ($member = mysql_fetch_assoc($getMembers))
		{
			if ($oe == 2)
			{
				$oe = 1;
			}
			else
			{
				$oe = 2;
			}
	
			echo '<table width="107%" style="padding: 5px; margin-left: -15px; background-color: ' . (($oe == 2) ? '#fff' : '#E6E6E6') . ';">
			<tbody>
				<tr>
					<td valign="middle" width="25">
						<img style="margin-top: -10px;" src="http://www.habbo.com/habbo-imaging/avatarimage?figure=' . $member['look'] . '&action=wav&size=l">
					</td>
					<td valign="top">
						<b style="font-size: 110%;">' . clean($member['username']) . '</b><br />
						<i>' . clean($member['motto']) . '</i><br />
						<br />';
						
					$getBadges = dbquery("SELECT * FROM user_badges WHERE user_id = '" . $member['id'] . "' AND badge_slot >= 1 ORDER BY badge_slot DESC LIMIT 5");
					
					while ($b = mysql_fetch_assoc($getBadges))
					{
						echo '<img src="http://images.habbo.com/c_images/album1584/' . $b['badge_id'] . '.gif" style="float: left;">&nbsp;';
					}
						
					echo '</td>
					<td valign="top" style="float: right;">
						' . (($member['online'] == "1") ? '<img src="../images/online.gif">' : '<img src="../images/offline.gif">') . '
					</td>
				</tr>
			</tbody>
			</table>';
		}
	}
	else
	{
		echo '<i>N�o h� usu�rios neste grupo ainda.</i>';
	}
	
	echo '</div>
	</div> 
</div>
<script type="text/javascript">if (!$(document.body).hasClassName(\'process-template\')) { Rounder.init(); }</script> ';
}

?>