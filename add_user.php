<?php
	include 'header_login.php';
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
<form class="loginBox signin pb-3" method="post" action="create_facility.php">
	<div class="bg-info text-light p-2 mb-3 lead">Register</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="first_name" placeholder="First Name" required>
	</div>
    <div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="middle_name" placeholder="Middle Name">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="last_name" placeholder="Last Name" required>
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-user"></i></div>
		<input class="form-control mb-2" type="text" name="maternal_last_name" placeholder="Second Last Name">
	</div>
    <div class="form-group mx-3">
		<input class="form-control mb-2" type="date" name="dob" placeholder="Date of Birth" required>
	</div>
	<div class="form-group mx-3">
		<select class="form-control mb-2" name="sex" required>
			<option value="M">M</option>
			<option value="F">F</option>
		</select>
	</div>
	<div class="form-group mx-3">
		<select class="form-control mb-2" name="current_facility" required>
			<?php
			    while($row = $result->fetch_assoc()) {
	        		echo '<option value="'.$row['FacilityNumber'].'">'.$row['FacilityName'].' ('.$row['city'].', '.$row['state'].')</option>';
				}
			?>
    	</select>
	</div>
	<div class="form-group mx-3">
		<?php
			include 'country_select.php';
		?>	
	</div>

	<div class="form-group mx-3">
		<label for="photo">Upload picture:</label>
        <input class="form-control mb-2"
               type="file"
               id="photo" name="photo"
               accept="image/*" />
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-lock"></i></div>
		<input class="form-control mb-2" type="text" name="state" placeholder="state">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-lock"></i></div>
		<input class="form-control mb-2" type="text" name="zip" placeholder="zip">
	</div>
	<div class="form-group mx-3">
		<div class="input-icon"><i class="fa fa-lock"></i></div>
		<input class="form-control mb-2" type="text" name="poc" placeholder="point of contact full name">
	</div>
    <div class="form-group mx-3">
	    <div class="row">
			<input type="hidden" name="count" value="1" />
        	<div class="control-group" id="fields">
            	<label class="control-label" for="field1">Nice Multiple Form Fields</label>
            	<div class="controls" id="profs"> 
                	<form class="input-append">
                    	<div id="field"><input autocomplete="off" class="input" id="field1" name="prof1" type="text" placeholder="Type something" data-items="8"/><button id="b1" class="btn add-more" type="button">+</button></div>
                	</form>
            	<br>
            	<small>Press + to add another form field :)</small>
            	</div>
        	</div>
		</div>
	</div>
	<input class="btn btn-primary mx-3" type="submit" value="Create">
	<hr class="mx-3" />

</form>
<script>
	$(document).ready(function(){
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
<?php include 'footer_login.php'?>