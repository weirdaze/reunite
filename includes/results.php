<div class="d-flex align-items-center justify-content-center flex-wrap">
	<?php 
		$person_type_id = $_GET['person_type_id'];

		for($i=1; $i<=20; $i++){
	?>
		<div class="person d-flex align-items-center flex-column justify-content-center" data-uid="<?php echo 100 + $i; ?>" data-person_type_id="<?php echo $person_type_id; ?>">
			<i class="fa <?php if($person_type_id == '1'){ echo "fa-male"; } else { echo "fa-female"; } ?> fa-7x"></i>
			<div class="caption">person <?php echo $i ?></div>
		</div>	
	<?php
		}
	?>
</div>