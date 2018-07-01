<?php include 'header.php'; ?>
<div class="container py-3">
	<div id="selectPersonType">
		<h2 class="text-center mb-3">
				¿A quién estás buscando?
		</h2>
		<div class="row">
			<div class="col">
				<div class="card mb-3">
					<div class="card-body d-flex align-items-center justify-content-center flex-column">
						<i class="fa fa-male fa-7x"></i>
						<a class="selectPerson btn btn-primary text-light mt-3" data-person_type_id="1">
							Encuentra a mi <?php echo 'Hijo' ?>
						</a>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card mb-3">
					<div class="card-body d-flex align-items-center justify-content-center flex-column">
						<div><i class="fa fa-female fa-7x"></i></div>
						<a class="selectPerson btn btn-primary text-light mt-3" data-person_type_id="2">
							Encuentra a mi <?php echo 'Hija' ?>
						</a>
					</div>
				</div>
			</div>
		</div>
		<h2 class="text-center my-3">
			O busca por nombre
		</h2>
	</div>
	<div class="row">
		<div class="col">
			<div class="form-group">
				<input id="searchInput" name="search" class="form-control" placeholder="Search...">
				<a id="searchIcon"><i class="fa fa-search"></i></a>
			</div>
		</div>
	</div>
	<div id="results">

	</div>
</div>
<?php include 'footer.php'; ?>