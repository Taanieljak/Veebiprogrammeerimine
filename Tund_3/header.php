<?php
$weekDaysET = ["E","T","K","N","R","L","P"];
$weekDayToday = date("N");

if ($weekDayToday = "2"){
	echo "Täna on teisipäev";
}
if ($weekDayToday == 1){
	echo "Täna on esmaspäev";
}
if ($weekDayToday == 3){
	echo "Täna on kolmapäev";
}
if ($weekDayToday == 4){
	echo "Täna on neljapäev";
}
if ($weekDayToday == 5){
	echo "Täna on reede";
}
if ($weekDayToday == 6){
	echo "Täna on laupäev";
}
if ($weekDayToday == 7){
	echo "Täna on pühapäev";
}


 ?>

<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title>
  programmeerib veebi</title>
  
</head>
<body>
<?php
echo $userName;
?>
</body>