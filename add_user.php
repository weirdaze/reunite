<?php
	$admin = 1;
	include 'header.php';
	// this form is going to be for creating a user
?>
<style>
	body {
		background-color: #eee;
	}
</style>
<?php
    include('config.php');
    $current_facility = $_SESSION['current_facility'];
    $admin_username = $_SESSION['userid'];
    $execStr = "python /var/www/html/reunite/scripts/generate_uid.py ".$current_facility." ".$admin_username;
    $result = exec($execStr);
    $iuid = $result;
	
?>
<form class="formBox pb-3" name="adduser" method="post" action="processadduser.php" onsubmit="return validateForm()">
	<div class="bg-info text-light p-2 mb-3 lead">Register New User</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-id-card"></i></div>
		<input class="form-control mb-2" type="text" name="first_name" placeholder="First Name" pattern="[A-Za-z -]+" required>
		<small><p class="bg-warning" id="first_name1"></p></small>
	</div>
    <div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-id-card"></i></div>
		<input class="form-control mb-2" type="text" name="middle_name" placeholder="Middle Name" pattern="[A-Za-z -]+">
		<small><p class="bg-warning" id="middle_name1"></p></small>
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-id-card"></i></div>
		<input class="form-control mb-2" type="text" name="last_name" placeholder="Last Name" pattern="[A-Za-z -]+" required>
		<small><p class="bg-warning" id="last_name1"></p></small>
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-id-card"></i></div>
		<input class="form-control mb-2" type="text" name="maternal_last_name" placeholder="Second Last Name" pattern="[A-Za-z -]+">
		<small><p class="bg-warning" id="maternal_last_name1"></p></small>
	</div>
	<label class="mx-3">Date of Birth:</label>
    <div class="form-group mx-3">
    	<div class="input-icon"><i class="fa fa-calendar-alt"></i></div>
		<input class="form-control mb-2 placeholder" type="date" name="dob" required>
	</div>
	<div class="form-group mx-3">
		<div class="custom-control custom-radio custom-control-inline">
			<input type="radio" id="sex_1" name="sex" class="custom-control-input" value="m" required>
			<label class="custom-control-label" for="sex_1">Male</label>
		</div>
		<div class="custom-control custom-radio custom-control-inline">
			<input type="radio" id="sex_2" name="sex" class="custom-control-input" value="f" required>
			<label class="custom-control-label" for="sex_2">Female</label>
		</div>
	</div>
	<div class="form-group mx-3">
		<input type="hidden" name="current_facility" value="<?php echo $current_facility;?>">
	</div>
	<div class="form-group mx-3">
		<input type="hidden" name="uid" id="uid" value="<?php echo $iuid;?>">
	</div>
	<div class="form-group mx-3">
		<!-- <label class="">Country:</label> -->
		<select class="custom-select form-control mb-2" name="country" required>
			<?php
				include 'country_select.php';
			?>
		</select>
	</div>

	<div class="form-group mx-3">
		<div class="input-group">
			<div class="custom-file">
	       		<input class="custom-file-input mb-2" type="file" id="photo" name="photo" accept="image/*"/>
	       		<label class="custom-file-label placeholder" for="photo">Upload Photos</label>
	       		<input type="hidden" name="photos">
	        </div>
        </div>
        <div id="imgThumbnails">
			
        </div>
	</div>
	<div class="form-group mx-3">
		<div class="input-group">
			<div class="custom-file">
	       		<input class="custom-file-input mb-2" type="file" id="video" name="video" accept="video/*"/>
	       		<label class="custom-file-label placeholder" for="photo">Upload Video</label>
	       		<input type="hidden" name="videos">
	        </div>
        </div>
        <div id="vidThumbnails">
			
        </div>
	</div>
	<div class="form-group mx-3">
		<div class="custom-control custom-radio custom-control-inline">
			<input type="radio" id="type_1" name="type" class="custom-control-input" value="adult" required>
			<label class="custom-control-label" for="type_1">Adult</label>
		</div>
		<div class="custom-control custom-radio custom-control-inline">
			<input type="radio" id="type_2" name="type" class="custom-control-input" value="child" required>
			<label class="custom-control-label" for="type_2">Child</label>
		</div>
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-building"></i></div>
		<input class="form-control mb-2" type="text" name="facility_uid" placeholder="ID from current facility" pattern="[A-Za-z0-9 &#.-]+">
		<small><p class="bg-warning" id="facility_uid1"></p></small>
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-map-marker-alt"></i></div>
		<input class="form-control mb-2" type="text" name="entry_point" placeholder="Point of Entry into USA" pattern="[A-Za-z0-9 &#.-,]+">
		<small><p class="bg-warning" id="entry_point1"></p></small>
	</div>
	<label class="mx-3">Date Detained:</label>
	<div class="form-group mx-3">
    	<div class="input-icon"><i class="fa fa-calendar-alt"></i></div>
		<input class="form-control mb-2 placeholder" type="date" name="date_detained">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="rel1" placeholder="Relative Full Name (Relation)" pattern="[A-Za-z -,)(]+">
		<p id="rel1"></p>
	</div>
	<div class="d-flex align-items-center justify-content-end">
		<a id="removeRelative" class="btn btn-danger mr-2 text-light hidden" data-toggle="tooltip" data-title="Remove Relative"><i class="fa fa-user-times"></i></a>
		<a id="addRelative" class="btn btn-secondary mr-3 text-light" data-toggle="tooltip" data-title="Add Relative"><i class="fa fa-user-plus"></i></a>
	</div>
	<input class="btn btn-primary ml-3 mr-2" type="submit" name="submit" value="Create">
	<a href="admintools.php?clear_temp=1" class="btn btn-secondary">Cancel</a>	
</form>
<script>
	function validateForm() {
    	var first_name = document.forms["adduser"]["first_name"].value;
    	var middle_name = document.forms["adduser"]["middle_name"].value;
    	var last_name = document.forms["adduser"]["last_name"].value;
    	var maternal_lastname = document.forms["adduser"]["maternal_last_name"].value;
    	var facility_uid = document.forms["adduser"]["facility_uid"].value;
    	var entry_point = document.forms["adduser"]["entry_point"].value;

    	if (first_name.includes("'") || first_name.includes(",")) {
        	document.getElementById("first_name1").innerHTML = "input cannot contain apostrophes or commas";
        	return false;
    	} else {document.getElementById("first_name1").innerHTML = "";}
    	if (middle_name.includes("'") || middle_name.includes(",")) {
        	document.getElementById("middle_name1").innerHTML = "input cannot contain apostrophes or commas";
        	return false;
    	} 
    	if (last_name.includes("'") || last_name.includes(",")) {
        	document.getElementById("last_name1").innerHTML = "input cannot contain apostrophes or commas";
        	return false;
    	} 
    	if (maternal_lastname.includes("'") || maternal_lastname.includes(",")){
        	document.getElementById("maternal_lastname1").innerHTML = "invalid zip code or commas";
        	return false;
    	} 
    	if (facility_uid.includes("'") || facility_uid.includes(",")) {
        	document.getElementById("facility_uid1").innerHTML = "input cannot contain apostrophes or commas";
        	return false;
    	} 
    	if (entry_point.includes("'") || entry_point.includes(",")) {
        	document.getElementById("entry_point1").innerHTML = "input cannot contain apostrophes or commas";
        	return false;
    	} 

	}
	$(document).ready(function(){
		$(".custom-select").select2({
			placeholder: "Choose Country"
		});

		$("#addRelative, #removeRelative").tooltip();

		$("input[name='dob']").change(function(){
			$(this).removeClass("placeholder");
		});

		$("#photo").change(function(){
			var iuid = $("#uid").val();
		    var img = new FormData();
		    img.append("image",$(this).get(0).files[0]);
		    var filename = $(this).get(0).files[0].name;
		    img.append("iuid",iuid);
		    /*console.log($(this).get(0).files[0]);*/
		    $("#imgThumbnails").append("<i class='fa fa-spinner fa-spin fa-lg'></i>");
		    $.ajax({
		    	type: "POST",
		    	url: "includes/imageuploads.php",
		    	processData: false,
		    	contentType: false,
		    	data: img,
		    	success: function(data){
		    		$("#imgThumbnails").find("i").remove();
		    		$("#imgThumbnails").html(data);
		    		var photoLabel = $("#photo").next(".custom-file-label");
		    		var newText = filename;
		    		photoLabel.removeClass("placeholder").text(newText);
		    		$("#photos").val(newText);
		    		var imageName = $("#imageName").val();
		    		$("#photo").val(imageName);
		    	}
		    });
		});

		$("#video").change(function(){
			//$(this).next(".custom-file-label").removeClass("placeholder").text($(this).get(0).files[0].name);
			var iuid = $("#uid").val();
			var vid = new FormData();
		    vid.append("video",$(this).get(0).files[0]);
		    var filename = $(this).get(0).files[0].name;
		    vid.append("iuid",iuid);
		    /*console.log($(this).get(0).files[0]);*/
		    $("#vidThumbnails").append("<i class='fa fa-spinner fa-spin fa-lg'></i>");
		    $.ajax({
		    	type: "POST",
		    	url: "includes/videouploads.php",
		    	processData: false,
		    	contentType: false,
		    	data: vid,
		    	success: function(data){
		    		$("#vidThumbnails").find("i").remove();
		    		$("#vidThumbnails").html(data);
		    		var videoLabel = $("#video").next(".custom-file-label");
		    		var newText = filename;
		    		videoLabel.removeClass("placeholder").text(newText);
		    		$("#videos").val(newText);
		    	}
		    });
		});

		var count = 1;
		$("#addRelative").click(function(){
			$(this).parent().before("\
				<div class='form-group mx-3 input-added'><div class='input-icon'><i class='fa fa-user'></i></div>\
				<input class='form-control' type='text' name='rel"+(count+1)+"' placeholder='Relative Full Name (Relation)'></div>\
			");
			$("#removeRelative").removeClass("hidden");
			count++;
		});

		$("#removeRelative").click(function(){
			$(".input-added").last().remove();
			$(".input-added").length > 0 ? "" : $(this).addClass("hidden");
			count--;
		});
	});
</script>
<?php include 'footer.php'?>