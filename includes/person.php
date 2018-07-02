
<div class="row">
	<div class="prevArrow col-1"><i class="fa fa-chevron-left fa-3x"></i></div>
	<div class="col">
		<div class="d-flex align-items-center justify-content-center mb-3">
			<i class="text-center fa fa-male fa-7x"></i>
		</div>
		<div class="d-flex align-items-center justify-content-center flex-wrap mb-3">
			<i class="fa fa-male fa-3x mr-3"></i>
			<i class="fa fa-male fa-3x mr-3"></i>
			<i class="fa fa-male fa-3x"></i>
		</div>
		<video width="100%" controls>
		    <source src="media/video/SampleVideo_1280x720_5mb.mp4" type="video/mp4">
		</video>
	</div>
	<div id="personDetails" class="col" data-uid="<?php echo $_GET['uid']; ?>" data-person_type_id="<?php echo $_GET['person_type_id']; ?>">
		<table class="table">
			<tr>
				<th>Sex:</th>
				<td>Male</td>
			</tr>
			<tr>
				<th>Date Detained:</th>
				<td>5/5/2018</td>
			</tr>
			<tr>
				<th>Entry Point:</th>
				<td>Nogales</td>
			</tr>
			<tr>
				<th>Current Facility:</th>
				<td>NYC</td>
			</tr>
			<tr>
				<th>Country of Origin:</th>
				<td>Honduras</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Relatives:</strong>
					<ul class="list-group mt-2">
						<li class="list-group-item">Maria (sister)</li>
						<li class="list-group-item">Sonia (cousin)</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Parent Names:</strong>
					<ul class="list-group mt-2">
						<li class="list-group-item">Pablo Doe</li>
						<li class="list-group-item">Maria Doe</li>
					</ul>
				</td>
			</tr>
		</table>
	</div>
	<div class="nextArrow col-1"><i class="fa fa-chevron-right fa-3x"></i></div>
</div>
