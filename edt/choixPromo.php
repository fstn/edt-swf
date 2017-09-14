<?php
session_start();
?>
<html>
<head>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;"> 
    <title>EMA Planning by Stephen ZAMBAUX</title>
    <body >
	<link rel="stylesheet" type="text/css" media="screen" href="iphone.css" />
<script>
 function getXMLHttpRequest() 
	  {
			var xhr = null;
			
			if (window.XMLHttpRequest || window.ActiveXObject) {
				if (window.ActiveXObject) {
					try {
						xhr = new ActiveXObject("Msxml2.XMLHTTP");
					} catch(e) {
						xhr = new ActiveXObject("Microsoft.XMLHTTP");
					}
				} else {
					xhr = new XMLHttpRequest(); 
				}
			} else {
				alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
				return null;
			}
			
			return xhr;
		}

	  function promoChoisie()
	  {
		var sVar1 = encodeURIComponent(document.getElementById("choixPromo").value);
		var sVar2 = encodeURIComponent(document.getElementById("choixDate").value);
		var sVar3 = encodeURIComponent(document.getElementById("choixJour").value);

		
		var xhr = getXMLHttpRequest();
		xhr.onreadystatechange = function() 
		{
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) 
			{
				document.getElementById("reponse").innerHTML = xhr.responseText;

			} 
		};
		
		xhr.open("GET", "getPlanning.php?promo="+sVar1+"&date="+sVar2+"&jour="+sVar3, true);
		xhr.send(null);

	  }
	   function getXMLHttpRequest() 
	  {
			var xhr = null;
			
			if (window.XMLHttpRequest || window.ActiveXObject) {
				if (window.ActiveXObject) {
					try {
						xhr = new ActiveXObject("Msxml2.XMLHTTP");
					} catch(e) {
						xhr = new ActiveXObject("Microsoft.XMLHTTP");
					}
				} else {
					xhr = new XMLHttpRequest(); 
				}
			} else {
				alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
				return null;
			}
			
			return xhr;
		}

	  
</script>
<body>
<div id="planning" >
<?php

include('PlanningCellule.php');
include('PlanningCol.php');
include('PlanningCours.php');
include('Promotion.php');

function getPromoFromCsv($file,$delimiter) { 
		$ch = curl_init($file);
		$fp = @fopen("temp", "w");
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_exec($ch);
		curl_close($ch);
		fclose($fp);
		$file = "temp";
        if (($handle = fopen($file, "r")) !== FALSE) { 
            $i = 0; 
            while (($lineArray = fgetcsv($handle, 4000, $delimiter)) !== FALSE) { 
				if(count($lineArray)-1 >0)
				{
				   for ($j=0; $j<count($lineArray)-1; $j++) { 
					//echo "[$i][$j] ".$lineArray[$j].'<br>';
						$tmp[$lineArray[$j]] = $lineArray[$j+1]; 
						
					} 
					$promo= new Promotion($tmp["P0"], $tmp["NOM"],$tmp["CFOND"],$tmp["CTEXTE"]);
				
					$data2DArray[$i]=$promo;
					
                } 
				$i++; 
            } 
            fclose($handle); 
        } 
        return $data2DArray; 
    }
	function echoArray($data)
	{
	
	$semaine=date("W");
	$date=date("W",$semaine);
	
	$oneweek = 60*60*24*7;
	$fiveday = 60*60*24*4;
	
	$premier_jour = mktime(0,0,0,date("m"),date("d")-date("w")+1,date("Y")); 
	$d = $premier_jour;
	
	$annee=date('Y');
	echo "<FORM>";
	echo"<SELECT  class=\"selectclass\" id=\"choixPromo\" name=\"nom\" size=\"1\" >";
		for($i=0;$i<count($data);$i++)
		{
			if( substr($data[$i]->nom, 0, strlen('INFRES 2A')) != "INFRES 2A")
			{
				echo "<OPTION value=\"".$data[$i]->id."\" >".$data[$i]->nom;
				echo "</OPTION>";
			}else
			{
				echo "<OPTION selected value=\"".$data[$i]->id."\" >".$data[$i]->nom;
				echo "</OPTION>";			
			}
		}
	echo"</SELECT>";
	echo "<br/>";
	echo"<SELECT class=\"selectclass\" id=\"choixDate\" name=\"date\" size=\"1\" >";
	for ($i = 0; $i < 52; $i++)
	{
		echo "<option value=\"".date("Ymd",$d)."\">";
		echo date("d-m-Y",$d)." au ".date("d-m-Y", $d + $fiveday)."</option>";
		
		$d += $oneweek;
	}
	echo"</SELECT>";
	echo"<SELECT  class=\"selectclass\" id=\"choixJour\" name=\"jour\" size=\"1\" >";
	$jours=array("lundi","mardi","mercredi","jeudi","vendredi","semaine entière");
	for ($i = 0; $i < 6; $i++)
	{
		if($i==5)
		{
			echo "<option selected value=\"".$i."\">";
		}
		else
		{
			echo "<option value=\"".$i."\">";
		}
		echo $jours[$i]."</option>";
	}
	echo"</SELECT>";
	
	echo "<input class=\"validclass\" type=\"button\" onClick=\"promoChoisie()\" value=\"Valider\" name=\"Valider\"></input>";
	echo"</FORM>";
	}
	$data=getPromoFromCsv('http://webdfd.mines-ales.fr/cybema/cgi-bin/cgiempt.exe?TYPE=promos_txt',';');
	echoArray($data);
    $jour=$jourDeLaSemaine=date("w");
	?>
	</div>
	<div id="reponse">
	</div>
	</body>
	</html>