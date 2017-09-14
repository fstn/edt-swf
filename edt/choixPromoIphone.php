<?php
session_start();
?>
<html>
  <head>
    <title>EMA Planning by Stephen ZAMBAUX</title>
    <meta name="viewport" content="user-scalable=no,width=device-width" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="apple-touch-startup-image" href="images/load.png" />
    <link rel="apple-touch-icon" href="images/logo.png" />
    <link rel="stylesheet" type="text/css" href="iui/t/default/default-theme.css" />
    <link rel="stylesheet" type="text/css" href="iui/iui.css" />
    <script type="text/javascript" src="iui/iui.js"></script>
  </head>
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
<div class="toolbar">
      <h1 id="pageTitle"></h1>
      <a id="backButton" class="button" href="#"></a>
</div>
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
	
	
	
    
    echo "<ul title=\"Promotions\" selected=\"true\">";
	for($i=0;$i<count($data);$i++)
		{
			if(substr($data[$i]->nom, 0, strlen('INFRES')) == "INFRES")
			{
				echo "<li> <a href=\"choixDate.php?promo=".$data[$i]->id."\">".$data[$i]->nom."</a></li>";
			}
		}
    echo "</ul>";
	
	
	}
	if($id==0)
	{
		$data=getPromoFromCsv('http://webdfd.mines-ales.fr/cybema/cgi-bin/cgiempt.exe?TYPE=promos_txt',';');
		echoArray($data);
		$jour=$jourDeLaSemaine=date("w");
	}
	else
	{
		$premier_jour = mktime(0,0,0,date("m"),date("d")-date("w")+1,date("Y")); 
		$d = $premier_jour;
		echo "<ul title=\"Promotions\" selected=\"true\">";
		echo "<li> <a href=\"choixJour.php?promo=".$id."&date=".date("Ymd",$d)."\">DEFAUT</a></li>";
		echo "</ul>";
	
		$jour=$jourDeLaSemaine=date("w");

	}
	?>
	</div>
	<div id="reponse">
	</body>
	</html>