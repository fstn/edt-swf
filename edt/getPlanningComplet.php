<link rel='stylesheet' type='text/css' href='fullcalendar/fullcalendar.css' />
<script type='text/javascript' src='/jquery/jquery-1.4.4.min.js'></script>
<script type='text/javascript' src='/fullcalendar/fullcalendar.js'></script>
<script>
$(document).ready(function() {

    // page is now ready, initialize the calendar...
	var d = new Date();
	var y = d.getFullYear();
	var m = d.getMonth();
	var j = d.getDay();
    $(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('#calendar').fullCalendar({
			editable: true,
            weekends: false ,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultView: 'agendaWeek',
			minTime:'7:30',
			maxTime:'19:30',
			events: [
				
				
			
		
<?php

include('PlanningCellule.php');
include('PlanningCol.php');
include('PlanningCoursComplet.php');
include('Promotion.php');

function debutsem($n)
{
    $premier_jour = mktime(0,0,0,date("m"),date("d")-date("w")+1-$n*7,date("Y"))
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
					$cours= new PlanningCoursComplet($tmp["COURS"], $tmp["PROF"],$tmp["SALLE"],$tmp["HD"],$tmp["HF"],$tmp["DATE"],$tmp["CFOND"],$tmp["GROUPE"]);
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
				
				//$colonne=new PlanningCol($jourDeLaSemaine, 8, 18, $data[$i]->couleur);
				//$_SESSION["colonne"][$jourDeLaSemaine]=$colonne->getString($contenusCellules);	
				//$contenusCellules[] = new PlanningCellule($jour,$data[$i]);
				
		/*		 $this->cours = $cours;
        $this->prof = $prof;
        $this->salle = $salle;
        $this->heureDebut = $this->miseEnFormeHeure($heureDebut);
        $this->heureFin = $this->miseEnFormeHeure($heureFin);
        $this->classement = $classement;
        $this->groupe = str_replace(" ","",$groupe);*/
				echo "{\n";
				echo "	title: '".$data[$i]->cours." <br/>". $data[$i]->salle ." <br/> ".$data[$i]->prof."',\n";
				echo "	start: new Date(".$data[$i]->annee.", ".$data[$i]->mois.", ".$data[$i]->jour.",  ".$data[$i]->heureDebut.", ".$data[$i]->minuteDebut."),\n";
				echo "	end: new Date(".$data[$i]->annee.", ".$data[$i]->mois.", ".$data[$i]->jour.",  ".$data[$i]->heureFin.", ".$data[$i]->minuteFin."),\n";
				echo "	allDay: false\n";
				echo "}\n";
				
			}
			if( $i!=count($data)-1)
			{
				echo ",\n";
			}
			
			$finCompteur=$i;
		}
		
		$colonne=new PlanningCol($jour, 8, 18, $data[$finCompteur]->couleur);
		/*echo "<html>";
	
		echo "<body>";
		echo "<ul title=\"".$date."\" selected=\"true\">";
		echo $colonne->afficher($contenusCellules);
		echo "</body>";
		echo "</html>";*/
	}
	
 
$id = (isset($_GET["promo"])) ? $_GET["promo"] : NULL;
$date = (isset($_GET["date"])) ? $_GET["date"] : NULL;

$jour = (isset($_GET["jour"])) ? $_GET["jour"] : NULL;
if($jour!=NULL)
{
$annee=substr($date,0,4);
$mois=substr($date,-4,2);
$day=substr($date,-2,2);
$date=date("Ymd", mktime(0, 0, 0,$mois,$day,$annee)+$jour*24*3600);
}
//if ($id) {
$date=date("Ymd");
		$dateDebut= $date;
		$dateFin=$date+30;
		//$data=getPlanningFromCsv('http://cybema.ema.fr/cybema/cgi-bin/cgiempt.exe?TYPE=planning_txt&DATEDEBUT='.$dateDebut.'&DATEFIN='.$dateFin.'&TYPECLE=p0cleunik&VALCLE='.$id.'',';');
		$data=getPlanningFromCsv('http://cybema.ema.fr/cybema/cgi-bin/cgiempt.exe?TYPE=planning_txt&DATEDEBUT='.$dateDebut.'&DATEFIN='.$dateFin.'&TYPECLE=p0cleunik&VALCLE=42',';');
		$data=trie($data);
		echoArray($data);
		$jourDeLaSemaine=$jour;
	
/*} else {
	echo "FAIL";
$date=date("Ymd");
		$dateDebut= $date;
		$dateFin=$date+30;
}*/

?>
	
			]
		});
	});
 });
</script> 

<div id='calendar'></div>
