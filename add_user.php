<?php
	include 'header.php';
	// this form is going to be for creating a facility
?>

<style>
	body {
		background-color: #eee;
	}
</style>
<?php
    include('config.php');
    $sql = "SELECT FacilityNumber, FacilityName, city, state FROM facilities";
	$result = mysqli_query($db,$sql);
	
?>
<form class="formBox pb-3" method="post" action="create_facility.php">
	<div class="bg-info text-light p-2 mb-3 lead">Register New User</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-id-card"></i></div>
		<input class="form-control mb-2" type="text" name="first_name" placeholder="First Name" required>
	</div>
    <div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-id-card"></i></div>
		<input class="form-control mb-2" type="text" name="middle_name" placeholder="Middle Name">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-id-card"></i></div>
		<input class="form-control mb-2" type="text" name="last_name" placeholder="Last Name" required>
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-id-card"></i></div>
		<input class="form-control mb-2" type="text" name="maternal_last_name" placeholder="Second Last Name">
	</div>
    <div class="form-group mx-3">
    	<div class="input-icon"><i class="fa fa-calendar-alt"></i></div>
		<input class="form-control mb-2" type="date" name="dob" placeholder="Date of Birth" required>
	</div>
	<div class="form-group mx-3">
		<div class="custom-control custom-radio custom-control-inline">
			<input type="radio" id="sex_1" name="sex" class="custom-control-input" value="m">
			<label class="custom-control-label" for="sex_1">Male</label>
		</div>
		<div class="custom-control custom-radio custom-control-inline">
			<input type="radio" id="sex_2" name="sex" class="custom-control-input" value="f">
			<label class="custom-control-label" for="sex_2">Female</label>
		</div>
	</div>
	<div class="form-group mx-3">
		<select class="custom-select form-control mb-2" name="current_facility" required>
			<option value=""><div class="input-icon">Choose Facility</option>
			<?php
			    while($row = $result->fetch_assoc()) {
	        		echo '<option value="'.$row['FacilityNumber'].'">'.$row['FacilityName'].' ('.$row['city'].', '.$row['state'].')</option>';
				}
			?>
    	</select>
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
	       		<input class="custom-file-input mb-2" type="file" id="photo" name="photo" accept="image/*" multiple/>
	       		<input type="hidden" name="photos">
	       		<label class="custom-file-label" for="photo">Upload Photos</label>
	        </div>
        </div>
        <div id="imgThumbnails">
			
        </div>
	</div>
	<div class="form-group mx-3">
		<div class="input-group">
			<div class="custom-file">
	       		<input class="custom-file-input mb-2" type="file" id="video" name="video" accept="video/*"/>
	       		<label class="custom-file-label" for="photo">Upload Video</label>
	        </div>
        </div>
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-address-card"></i></div>
		<input class="form-control mb-2" type="text" name="state" placeholder="State">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-address-card"></i></div>
		<input class="form-control mb-2" type="text" name="zip" placeholder="Zip">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="poc" placeholder="Point of Contact Full Name">
	</div>
    <div class="form-group mx-3">
		<input type="hidden" name="count" value="1" />
    	<div class="control-group" id="fields">
        	<label class="control-label" for="field1">Nice Multiple Form Fields</label>
        	<div class="controls" id="profs"> 
            	<div class="input-append">
                	<div id="field">
                		<input autocomplete="off" class="form-control" id="field1" name="prof1" type="text" placeholder="Type something" data-items="8"/>
                		<button id="b1" class="btn add-more" type="button">+</button>
                	</div>
            	</div>
        	<br>
        	<small>Press + to add another form field :)</small>
        	</div>
    	</div>
	</div>
	<input class="btn btn-primary ml-3 mr-2" type="submit" value="Create">
	<a href="admintools.php?clear_temp=1" class="btn btn-secondary">Cancel</a>
</form>
<script>
	$(document).ready(function(){
		$(".custom-select").select2();

		$("#photo").change(function(){
		    var img = new FormData();
		    img.append("image",$(this).get(0).files[0]);
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
		    		$("#imgThumbnails").append(data);
		    	}
		    });
		});

		$("#video").change(function(){
			$(this).next(".custom-file-label").text($(this).get(0).files[0].name);
		});

	    var next = 1;
	    $(".add-more").click(function(e){
	        e.preventDefault();
	        var addto = "#field" + next;
	        var addRemove = "#field" + (next);
	        next = next + 1;
	        var newIn = '<input autocomplete="off" class="input form-control" id="field' + next + '" name="field' + next + '" type="text">';
	        var newInput = $(newIn);
	        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
	        var removeButton = $(removeBtn);
	        $(addto).after(newInput);
	        $(addRemove).after(removeButton);
	        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
	        $("#count").val(next);  
	        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#field" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
	    });   
	});
</script>
<?php include 'footer.php'?>