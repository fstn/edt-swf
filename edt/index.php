<?php 
$ua = $_SERVER['HTTP_USER_AGENT']; //on recupere le user agent du navigateur
$id=0;
if (@eregi("iPhone",$ua)) 
{
	if(isset($_GET["promo"]))
	{
		$id=$_GET["promo"];
	}
	include('choixPromoIphone.php');
}
else if (@eregi("android",$ua)) 
{
	include('choixPromoIphone.php');
}
else if (@eregi("MSIE",$ua) || @eregi("Mozilla",$ua) || @eregi("Opera",$ua) || @eregi("Chrome)",$ua) )
{
	include('indexFlash.php');
}
else
{
	include('choixPromo.php');
}



?>