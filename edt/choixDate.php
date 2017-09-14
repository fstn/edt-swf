<?php
	session_start();
?>
<html>
  <body>
<?php

	$promo=$_GET['promo'];
	$semaine=date("W");
	$date=date("W",$semaine);
	
	$oneweek = 60*60*24*7;
	$fiveday = 60*60*24*4;
	
	$premier_jour = mktime(0,0,0,date("m"),date("d")-date("w")+1,date("Y")); 
	$d = $premier_jour;
	
	$annee=date('Y');
	
	echo "<ul title=\"Planning\" selected=\"true\">";
	for ($i = 0; $i < 52; $i++)
	{
			echo "<li> <a href=\"choixJour.php?promo=".$promo."&date=".date("Ymd",$d)."\">".date("d-m-Y",$d)." au ".date("d-m-Y", $d + $fiveday)."</a></li>";
			$d += $oneweek;
	}
    echo "</ul>";
?>
</body>
</html>