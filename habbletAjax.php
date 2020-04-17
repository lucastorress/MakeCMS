<?php
/*=========================================================
| HabboRetro ~ CMSE - Content Management Systems Expert
| #########################################################
| HabboRetro release_4 Developed by bil & Meth0d
| Parts by Sisija and bil
| Visit Meth0d.org , Portal-Habbo.com.br
| #########################################################
| Cms developed to improve the delivery system of your
| habbo private if you have questions, suggestions or any
| bugs reportal please contact: gabriel_bil123@hotmail.com
| #########################################################
| Content license: Creative Commons 3.0 BY
| Code license: Apache License 2.0
\=========================================================*/

require_once "global.php";

$cmd = '';

if (isset($_GET['cmd']))
{
	$cmd = $_GET['cmd'];
}

switch (strtolower($cmd))
{
	case 'new_redeemvoucher':
	
		if (!LOGGED_IN)
		{
			exit;
		}
	
		echo '<div class="redeem-redeeming"><div><input type="text" name="voucherCode" value="" class="redeemcode" size="8" /></div><div class="redeem-redeeming-button"><a href="#" class="new-button green-button redeem-submit"><b><span></span>Gerar</b><i></i></a></div></div>';

		$findVoucher = dbquery("SELECT value FROM credit_vouchers WHERE code = '" . filter($_POST['voucherCode']) . "' LIMIT 1");
		
		if (mysql_num_rows($findVoucher) >= 1)
		{
			$value = intval(mysql_result($findVoucher, 0));
		
			echo '<div class="redeem-result"><div class="rounded rounded-green">Codigo gerado com sucesso, <b>' . $value . '</b> Moedas.</div></div>';
		
			dbquery("UPDATE users SET credits = credits + " . $value . " WHERE id = '" . USER_ID . "' LIMIT 1");
			dbquery("DELETE FROM credit_vouchers WHERE code = '" . filter($_POST['voucherCode']) . "' LIMIT 1");		
			$core->Mus('updateCredits', USER_ID);
		}
		else
		{
			echo '<div class="redeem-result"><div class="rounded rounded-red">Codigo de moedas errado</div></div>';
		}
	
		break;

	case 'updatemotto':
	
		if (!LOGGED_IN)
		{
			exit;
		}
		
		if (isset($_POST['motto']))
		{
			$motto = filter(trim(uberCore::FilterSpecialChars(substr($_POST['motto'], 0, 40))));
			
			dbquery("UPDATE users SET motto = '" . $motto . "' WHERE id = '" . USER_ID . "' LIMIT 1");		
			$core->Mus('updatemotto', USER_ID);
			
			die(clean($motto));
		}
		
		break;
}
	
?>
