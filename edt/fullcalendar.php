<link rel='stylesheet' type='text/css' href='fullcalendar/fullcalendar.css' />
<script type='text/javascript' src='/jquery/jquery-1.4.4.min.js'></script>
<script type='text/javascript' src='/fullcalendar/fullcalendar.js'></script>
<script>
$(document).ready(function() {

    $(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		console.info("date"+y+" "+d+" "+m);
		$('#calendar').fullCalendar({
			editable: true,
            weekends: false ,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultView: 'agendaWeek',
			events: [
				
				{
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					end: new Date(y, m, d, 17, 30),
					allDay: false
				},
				{
	title: 'UNIX LINUX ',
	start: new Date(2011, 0, 10,  09,0),
	end: new Date(2011, 0, 10,  12,0),
	allDay: false
}

			]
		});
	});
 });
</script> 
	

});
</script>
<div id='calendar'></div>
<?php

include('PlanningCellule.php');
include('PlanningCol.php');
include('PlanningCours.php');
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
	
$dateDebut=debutsem();
$dateFin=$dateDebut+5;
$id=42;

		$dateDebut= $date;
		$dateFin=$dateDebut;
		$data=getPlanningFromCsv('http://cybema.ema.fr/cybema/cgi-bin/cgiempt.exe?TYPE=planning_txt&DATEDEBUT='.$dateDebut.'&DATEFIN='.$dateFin.'&TYPECLE=p0cleunik&VALCLE='.$id.'',';');
		
		$data=trie($data);
		print_r($data);
		$jourDeLaSemaine=$jour;
	

?>
