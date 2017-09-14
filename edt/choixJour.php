<html>
  <body>
<?php
$promo=$_GET['promo'];
$date=$_GET['date'];
	echo "<ul title=\"Planning\" selected=\"true\">";
	$jours=array("lundi","mardi","mercredi","jeudi","vendredi","semaine entière");	
	for ($i = 0; $i < 6; $i++)
	{
			echo "<li> <a href=\"getPlanning.php?promo=".$promo."&date=".$date."&jour=".$i."\">".$jours[$i]."</a></li>";
	}
    echo "</ul>";
?>
</body>
</html>