<?php 
$ua = $_SERVER['HTTP_USER_AGENT']; //on recupere le user agent du navigateur
if (@eregi("iPhone",$ua)) 
{
	include('choixPromoIphone.php');
}
else if (@eregi("android",$ua)) 
{
	include('choixPromoIphone.php');
}
else if (@eregi("MSIE",$ua) || @eregi("Mozilla",$ua) || @eregi("Opera",$ua) || @eregi("Chrome)",$ua) )
{
	include('choixPromo.php');
}
else
{
	include('choixPromo.php');
}



?>