<?php
  $userName = "Taaniel Jakobson";
  $fullTimeNow = date("d.m.Y H:i:s");
  $hourNow = date("H");
  $partOfDay = "hägune aeg";
  require ("header.php");
  if ($hourNow >=17) {
	  $partOfDay = "õhtu";
  }
  else ($partOfDay)
?>
<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title>
  <?php
  echo $userName;
  ?>
  programmeerib veebi</title>
  
</head>
<body>
<?php
  echo "<h1>" .$userName .", veebiprogrammeerimine</h1>";
?>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<hr>
<?php
  echo "<p>Lehe avamise hetkel oli aeg: " .$fullTimeNow .".</p>";
  echo $partOfDay
?>
</body>
</html>