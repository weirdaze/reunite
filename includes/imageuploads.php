<?php
	session_start();
	$target_dir = "media/photo/";
	$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
	$current_iuser_id = $_POST["iuid"];
	$execStr = "python /var/www/html/reunite/scripts/rename_upload.py ".$_FILES['image']['name']." ".$current_iuser_id."  photo";
	//$target_file = $target_dir . basename( $_FILES['image']['name'],'.' . $ext) . "_" . $_SESSION['userid'] . '.' . $ext;
	$result1 = exec($execStr);
	$target_file = $target_dir . $result1;
	$target_file_dir = "/var/www/html/reunite/" . $target_file;
	$uploadOk = 1;
	$imageFileType = strtolower($ext);
	// Check if image file is a actual image or fake image
	if(isset($_POST["image"])){
	    $check = getimagesize($_FILES["image"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check file size
	if($_FILES["image"]["size"] > 3000000){
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if($uploadOk == 0){
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} 
	else {
		if(file_exists($target_file_dir)){
		    unlink($target_file_dir);
		}
	    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file_dir)){
	        // echo "The file ". basename($_FILES["image"]["name"]) . " has been uploaded.";
	        echo "<img class='thumbnail' src='$target_file'/> <input type='hidden' name='photo1' id='photo1' value='$result1'>";
	    } 
	    else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}
?>