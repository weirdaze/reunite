<?php
	session_start();
	$target_dir = "media/video/temp/";
	$ext = pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);
	$target_file = $target_dir . basename( $_FILES['video']['name'],'.' . $ext) . "_" . $_SESSION['userid'] . '.' . $ext;
	$target_file_dir = "/var/www/html/reunite/" . $target_file;
	$uploadOk = 1;
	$videoFileType = strtolower($ext);
	// Check if image file is a actual image or fake image
	if(isset($_POST["video"])){
	    $check = getimagesize($_FILES["video"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is a video - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not a video.";
	        $uploadOk = 0;
	    }
	}
	// Check file size
	if($_FILES["video"]["size"] > 7000000){
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($videoFileType != "mp4" && $videoFileType != "mov" && $videoFileType != "mpeg4" && $videoFileType != "avi" ) {
	    echo "Sorry, only mp4, mov, mpeg4 & avi files are allowed.";
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
	    if(move_uploaded_file($_FILES["video"]["tmp_name"], $target_file_dir)){
	        // echo "The file ". basename($_FILES["image"]["name"]) . " has been uploaded.";
	        echo "<img class='thumbnail' src='$target_file'/>";
	    } 
	    else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}
?>