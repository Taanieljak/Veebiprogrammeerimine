<?php
  require("../../../config_vp2019.php");
  require("functions_main.php");
  require("functions_user.php");
  require("functions_pic.php");
  $database = "if19_taaniel_ja_1";
  
  //kui pole sisseloginud
  if(!isset($_SESSION["userId"])){
	  //siis jõuga sisselogimise lehele
	  header("Location: page.php");
	  exit();
  }
  
  //väljalogimine
  if(isset($_GET["logout"])){
	  session_destroy();
	  header("Location: page.php");
	  exit();
  }
  
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  
  $notice = null;
  $maxPicW = 600;
  $maxPicH = 400;
  
  //var_dump($_POST);
  //var_dump($_FILES);
  
  //pildi üleslaadimise osa
	$uploadOk = 1;
	// Check if image file is an actual image or fake image
	if(isset($_POST["submitPic"])) {
		//$target_file = $pic_upload_dir_orig . basename($_FILES["fileToUpload"]["name"]);
		//$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
		$fileName= "vp_";
		$timeStamp = microtime(1)*10000;
		$fileName .= $timeStamp ."." .$imageFileType;
		$target_file = $pic_upload_dir_orig .$fileName;
		
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	
	// Check file size
		if ($_FILES["fileToUpload"]["size"] > 2500000) {
			echo "Vabandust, pildifail on liiga suur.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			//teeme pici väiksemaks
			//loeme pildifaili sisu pikslikogumikis ehk "pildiobjektiks"
			if($imageFileType == "jpg" or $imageFileType == "jpeg"){
				$myTempImage= imagecreatefromjpeg($_FILES["fileToUpload"]["tmp_name"]);
			}
			if($imageFileType == "png"){
				$myTempImage= imagecreatefrompng($_FILES["fileToUpload"]["tmp_name"]);
			}
			if($imageFileType == "gif"){
				$myTempImage= imagecreatefromgif($_FILES["fileToUpload"]["tmp_name"]);
			}
			
			$imageW= imagesx($myTempImage);
			$imageH= imagesy($myTempImage);
			
			//kontrollin kas on liiga suur pilt pikslite poolest
			if($imageW > $maxPicW or $imageH > $maxPicH){
				if($imageW / $maxPicW > $imageH / $maxPicH) {
					$picSizeRatio = $imageW / $maxPicW;
				} else {
					$picSizeRatio = $imageH / $maxPicH;
				}
				$imageNewW = round($imageW / $picSizeRatio, 0);
				$imageNewH = round($imageH / $picSizeRatio, 0);
				$myNewImage = setPicSize($myTempImage, $imageW, $imageH, $imageNewW, $imageNewH);
				
				//kirjutame vähendatud pildi faili
				if($imageFileType == "jpg" or $imageFileType == "jpeg"){
					if(imagejpeg($myNewImage, $pic_upload_dir_w600 .$fileName, 90)) {
						$notice= "Vähendatud faili salvestamine õnnestus!";
					} else {
						$notice ="Vähendatud faili salvestamine ei õnnestunud!@@@@@@";
					}
				}
				if($imageFileType == "png" or $imageFileType == "png"){
					if(imagepng($myNewImage, $pic_upload_dir_w600 .$fileName, 6)) {
						$notice= "Vähendatud faili salvestamine õnnestus!";
					} else {
						$notice ="Vähendatud faili salvestamine ei õnnestunud!@@@@@@";
					}
				}
				if($imageFileType == "gif" or $imageFileType == "gif"){
					if(imagegif($myNewImage, $pic_upload_dir_w600 .$fileName)) {
						$notice= "Vähendatud faili salvestamine õnnestus!";
					} else {
						$notice ="Vähendatud faili salvestamine ei õnnestunud!@@@@@@";
					}
				}
				imagedestroy($myTempImage);
				imagedestroy($myNewImage);
			}//_________________________________
			
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}
  //_______________________________________________
  require("header.php");
?>

  <?php
    echo "<h1>" .$userName ." koolitöö leht</h1>";
  ?>
  <p>See leht on loodud koolis õppetöö raames
  ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <p><a href="?logout=1">Logi välja!</a> | <a href="home.php">Tagasi avalehele</a></p>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
	  <label>Vali üleslaetav pildifail</label><br>
	  <input type="file" name="fileToUpload" id="fileToUpload">
	  <br>
	  <input name="submitPic" type="submit" value="Lae pilt üles"><span><?php echo $notice; ?></span>
	</form>
  <hr>
  
</body>
</html>





