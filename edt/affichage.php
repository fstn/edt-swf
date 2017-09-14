<?php
session_start();
$_SESSION['jour']=$_GET['jour'];
print_r($_SESSION);
$id=$_SESSION['id'];
$date=$_SESSION['date'];
$jour=$_SESSION['jour'];
echo $id;
echo $date;
echo $jour;
echo "window.location=\"/getPlanning.php?promo=$id&date=$date&jour=$jour\";";


?>