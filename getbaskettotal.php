
<?php

function _getbaskettotal(){

	if (!isset( $_COOKIE["borislp_basket"])) {
			return "0.0";
		}
	else{
		$basketid=$_COOKIE["borislp_basket"];
		$ftotal = 0.00;

		$itementry=_sqlqueryfunc_eh("SELECT f.price, lpc.quantity FROM products f, lpbasket_entry_global lpc WHERE lpc.basketid=$basketid and lpc.prodid=f.uid");
		$frow=mysqli_fetch_array($itementry);
		while ($frow){
		   $fline = $frow["price"] * $frow["quantity"];
			$ftotal=$ftotal + $fline;
			$frow=mysqli_fetch_array($itementry);
		}

		return $ftotal;

	}
}

?>