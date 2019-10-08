<?php
  $pageHeaderHTML = "<!DOCTYPE html> \n";
  $pageHeaderHTML .= '<html lang="et">'. "\n";
  $pageHeaderHTML .= "<head> \n";
  $pageHeaderHTML .=  "\t" .'<meta charset="utf-8">' ."\n \t<title>" .$userName ." progeb veebi</title> \n";
  $pageHeaderHTML .= "</head>";
  echo $pageHeaderHTML;
  $mydescription = null;
  $mybgcolor = null;
  $mytxtcolor = null;
  $notice= null;
  
  $database = "if19_taaniel_ja_1";
  var_dump($_SESSION);
  function userPref(){
	  $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	  $stmt = $conn->prepare("INSERT INTO kasu_andmed (description, bgcolor, txtcolor) VALUES (?,?,?)");
	  echo $conn->error;
	  
if (isset($_POST["description"]) and !empty($_POST["description"])){
	$mydescription = test_input($_POST["description"]);
}
if (isset($_POST["bgcolor"]) and !empty($_POST["bgcolor"])){
	$mybgcolor = test_input($_POST["bgcolor"]);
}
	
if (isset($_POST["txtcolor"]) and !empty($_POST["txtcolor"])){
	$mytxtcolor = test_input($_POST["txtcolor"]);
}
}
if (!empty($mydescription) and !empty ($mybgcolor) and !empty ($mytxtcolor)){
	$notice = userPref($mydescription, $mybgcolor, $mytxtcolor);
}
  ?>
  
  <!DOCTYPE html>
<html lang="et">
  <head>
    <meta charset="utf-8">
	<title>Abbaadii</title>
  </head>
  
  <body>
  <?php echo $notice?>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Minu kirjeldus</label><br>
	  <textarea rows="10" cols="80" name="description"><?php echo $mydescription; ?></textarea>
	  <br>
	  <label>Minu valitud taustavärv: </label><input name="bgcolor" type="color" value="<?php echo $mybgcolor; ?>"><br>
	  <label>Minu valitud tekstivärv: </label><input name="txtcolor" type="color" value="<?php echo $mytxtcolor; ?>"><br>
	  <input name="submitProfile" type="submit" value="Salvesta profiil"><span><?php echo $notice; ?></span>
	</form>