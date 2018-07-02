$(document).ready(function(){
	$(document).on("click",".selectPerson",function(){
		var person_type_id = $(this).data("person_type_id");
		$.ajax({
			type: "GET",
			url: "includes/results.php",
			data: {"person_type_id": person_type_id},
			success: function(data){
				$("#results").html(data);
				$("#selectPersonType").slideUp(500);
			}
		});
	});
	$(document).on("click",".person",function(){
		var uid = $(this).data("uid");
		var person_type_id = $(this).data("person_type_id");
		$(".modal-body").html("<div id='spinner'><i class='fa fa-spinner fa-spin fa-7x'></i></div>");
		$(".modal").modal("show");
		$.ajax({
			type: "GET",
			url: "includes/person.php",
			data: {"uid": uid, "person_type_id": person_type_id},
			success: function(data){
				$(".modal-title").text("Juan Doe (UID: "+uid+")");
				person_type_id == 1 ? $("#claimMember").text("Es mi hijo!") : $("#claimMember").text("Es mi padre!")
				$(".modal-body").html(data);
				
			}
		});
	});
	$(document).on("click",".prevArrow, .nextArrow",function(){
		var uid = $("#personDetails").data("uid");
		var person_type_id = $("#personDetails").data("person_type_id");
		var direction = 1;
		$(this).hasClass("prevArrow") ? direction = -1 : "";
		var newUid = uid + direction;
		$(".modal-body").html("<div id='spinner'><i class='fa fa-spinner fa-spin fa-7x'></i></div>");
		$(".modal-title").text("");
		$.ajax({
			type: "GET",
			url: "includes/person.php",
			data: {"uid": newUid, "person_type_id": person_type_id},
			success: function(data){
				$(".modal-title").text("Juan Doe (UID: "+newUid+")");
				person_type_id == 1 ? $("#claimMember").text("Es mi hijo!") : $("#claimMember").text("Es mi padre!")
				$(".modal-body").html(data);
				$(".modal").modal("show");
			}
		});
	});
});