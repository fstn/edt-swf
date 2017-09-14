<?php
include('PlanningCellule.php');
include('PlanningCol.php');
include('PlanningCours.php');
include('Promotion.php');

function debutsem($date)
{

	$annee=substr($date,0,4);
	$mois=substr($date,-4,2);
	$day=substr($date,-2,2);
    $premier_jour = mktime(0,0,0,$mois,$day-date("w")+1-$n*7,$annee)
;
    $datedeb = date("Ymd", $premier_jour);

    return $datedeb;
}
function finsem($date)
{

	$annee=substr($date,0,4);
	$mois=substr($date,-4,2);
	$day=substr($date,-2,2);
    $premier_jour = mktime(0,0,0,$mois,$day+5,$annee)
;
    $datedeb = date("Ymd", $premier_jour);

    return $datedeb;
}
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
					$promo= new Promotion($tmp["PO"], $tmp["NOM"],$tmp["CFOND"],$tmp["CTEXTE"]);
					$data2DArray[$i]=$promo;
					
                } 
				$i++; 
            } 
            fclose($handle); 
        } 
        return $data2DArray; 
    } 
function getPlanningFromCsv($file,$delimiter) { 
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
					$cours= new PlanningCours($tmp["COURS"], $tmp["PROF"],$tmp["SALLE"],$tmp["HD"],$tmp["HF"],retourneTime($tmp["DATE"],$tmp["HD"]),$tmp["CFOND"],$tmp["GROUPE"]);
					$data2DArray[$i]=$cours;
                } 
				$i++; 
            } 
            fclose($handle); 
        } 
        return $data2DArray; 
    } 

 
	function miseEnFormeDate($date)
	{
		$jour="";
		$mois="";
		$annee="";
		$jour=substr($date,-2);
		$mois=substr($date,4,2);
		$annee=substr($date,0,4);
		return $jour."/".$mois."/".$annee;
	}
	
	function trie($data)
	{
		$tmp=0;
		$fin=0;
		$modification=0;
		while($fin==0)
		{
			$modification=0;
			for($i=0;$i<count($data)-1;$i++)
			{
				if($data[$i]->classement>$data[$i+1]->classement)
				{
					$modification++;
					$tmp=$data[$i+1];
					$data[$i+1]=$data[$i];
					$data[$i]=$tmp;
				}
			}
			if($modification==0)
			{
				$fin=1;
			}
		}
		return $data;
		
	}
	function retourneTime($date,$Heure)
	{
		$heure="";
		$minute="";
		$heure=substr($Heure,0,2);
		$minute=substr($Heure,2,2);
		
		$jour="";
		$mois="";
		$annee="";
		$jour=substr($date,-2);
		$mois=substr($date,4,2);
		$annee=substr($date,0,4);
		$tp=mktime($heure,$minute,0,$mois,$jour,$annee);
		return $tp;
	
	}
	
	function echoArray($data)
	{
		$nbJour;
		for($i=0;$i<count($data);$i++)
		{	
			if($data[$i]->cours!="")
			{
				$colonne=new PlanningCol($jourDeLaSemaine, 8, 18, $data[$i]->couleur);
				$_SESSION["colonne"][$jourDeLaSemaine]=$colonne->getString($contenusCellules);	
				$contenusCellules[] = new PlanningCellule($jour,$data[$i]);
				
				
			}
			$finCompteur=$i;
		}
		
		$colonne=new PlanningCol($jour, 8, 18, $data[$finCompteur]->couleur);
		echo "<html>";
	
		echo "<body>";
		echo "<ul title=\"".$date."\" selected=\"true\">";
		echo $colonne->afficher($contenusCellules);
		echo "</body>";
		echo "</html>";
	}
	function get2DArrayFromCsv($file,$delimiter) { 
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
						$tmp[$lineArray[$j]] = $lineArray[$j+1]; 
						
					} 
					$cours= new PlanningCours($tmp["COURS"], $tmp["PROF"],$tmp["SALLE"],$tmp["HD"],$tmp["HF"],retourneTime($tmp["DATE"],$tmp["HD"]),$tmp["CFOND"],$tmp["GROUPE"]);
					$data2DArray[$i]=$cours;
					
                } 
				$i++; 
            } 
            fclose($handle); 
        } 
        return $data2DArray; 
    } 
	
	function echoArraySemaine($data)
	{
		$jourDeLaSemaine=1;	
		$finCompteur=0;
		echo "<html>";
	
			echo "<body>";
			echo "<ul title=\"".$date."\" selected=\"true\">";
			echo "<div style=\"background-image:url(fond.jpg)\">";
		for($i=0;$i<count($data);$i++)
		{	
				if($data[$i]->cours!="")
				{
					if($jourDeLaSemaine!=date("w",$data[$i]->classement))
					{
						$colonne=new PlanningCol($jourDeLaSemaine, 8, 18, $data[$i]->couleur);
						$colonne->afficher($contenusCellules);	
						$jourDeLaSemaine=date("w",$data[$i]->classement);
						$contenusCellules=null;
										
					}
					$contenusCellules[] = new PlanningCellule($jourDeLaSemaine,$data[$i]);
					$jourDeLaSemaine=date("w",$data[$i]->classement);
					
				}
				$finCompteur=$i;
		}
			$colonne=new PlanningCol($jourDeLaSemaine, 8, 18, $data[$finCompteur]->couleur);
			
			echo $colonne->afficher($contenusCellules);
			echo "</div>";
			echo "</body>";
			echo "</html>";			
	}
	
 
$id = (isset($_GET["promo"])) ? $_GET["promo"] : NULL;
$date = (isset($_GET["date"])) ? $_GET["date"] : NULL;

$jour = (isset($_GET["jour"])) ? $_GET["jour"] : NULL;
if($jour!=NULL && $jour!=5)
{
	
	$annee=substr($date,0,4);
	$mois=substr($date,-4,2);
	$day=substr($date,-2,2);
	$date=date("Ymd", mktime(0, 0, 0,$mois,$day,$annee)+$jour*24*3600);

	if ($id)
	{
			$dateDebut= $date;
			$dateFin=$dateDebut;
			$data=getPlanningFromCsv('http://cybema.ema.fr/cybema/cgi-bin/cgiempt.exe?TYPE=planning_txt&DATEDEBUT='.$dateDebut.'&DATEFIN='.$dateFin.'&TYPECLE=p0cleunik&VALCLE='.$id.'',';');
		      //echo 'http://cybema.ema.fr/cybema/cgi-bin/cgiempt.exe?TYPE=planning_txt&DATEDEBUT='.$dateDebut.'&DATEFIN='.$dateFin.'&TYPECLE=p0cleunik&VALCLE='.$id.'';
        	$data=trie($data);
			echoArray($data);
			$jourDeLaSemaine=$jour;
		
	} else {
		echo "FAIL";
	}
}else
{

		//on initialise à la semaine en cours
	$oneweek = 60*60*24*7;
	$fiveday = 60*60*24*4;
	
	
	$dateDebut=debutsem($date);
	$dateFin=finsem($date);	
	$data=get2DArrayFromCsv('http://cybema.ema.fr/cybema/cgi-bin/cgiempt.exe?TYPE=planning_txt&DATEDEBUT='.$dateDebut.'&DATEFIN='.$dateFin.'&TYPECLE=p0cleunik&VALCLE='.$id.'',';');
	$data=trie($data);
	echoArraySemaine($data);

	echo'
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="KR4UB73YJLY2L">
	<input type="image" src="https://www.paypalobjects.com/WEBSCR-640-20110306-1/fr_FR/FR/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !">
	<img alt="" border="0" src="https://www.paypalobjects.com/WEBSCR-640-20110306-1/fr_FR/i/scr/pixel.gif" width="1" height="1">
	</form>
	';

}

?>
