<?php
    require("../../../config-vp2019.php");
	require("functions_user.php");
  $database = "if19_taaniel_ja_1";
  
  //kontrollime, kas on sisse logitud
  if(!isset($_SESSION["userId"])){
	  header("Location: page.php");
	  exit();
  }
  
  //Logime välja
  if(isset($_GET["logout"])){
	  session_destroy();
	  header("Location: page.php");
	  exit();
  }
  
  $userName = $_SESSION["userFirstname"]." " .$_SESSION["userLastname"];
  require ("header.php");
  echo "<h1>" .$userName .", veebiprogrammeerimine</h1>";
?>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<hr>
<br>
<p><?php echo $userName; ?> | Logi <a href="?logout=1">välja</a>!</p>

</body>
</html>