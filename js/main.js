$(document).ready(function(){
	$(document).on("click",".selectPerson",function(){
		var person_type_id = $(this).data("person_type_id");
		var complete = function() {
			$("#selectPersonType").slideUp(500);
		}
		updateContent("#results","includes/results.php",{"person_type_id": person_type_id},"",complete);
	});
	$(document).on("click",".person",function(){
		var uid = $(this).data("uid");
		var person_type_id = $(this).data("person_type_id");
		var before = function(){
			$(".modal").modal("show");
		}
		var complete = function(){
			$(".modal-title").text("Juan Doe (UID: "+uid+")");
			person_type_id == 1 ? $("#claimMember").text("Es mi hijo!") : $("#claimMember").text("Es mi padre!");
		}
		updateContent(".modal-body","includes/person.php",{"uid": uid, "person_type_id": person_type_id},before,complete);
	});
	$(document).on("click",".prevArrow, .nextArrow",function(){
		var uid = $("#personDetails").data("uid");
		var person_type_id = $("#personDetails").data("person_type_id");
		var direction = 1;
		$(this).hasClass("prevArrow") ? direction = -1 : "";
		var newUid = uid + direction;
		var before = function(){
			$(".modal-title").text("");
		}
		var complete = function(){
			$(".modal-title").text("Juan Doe (UID: "+newUid+")");
			person_type_id == 1 ? $("#claimMember").text("Es mi hijo!") : $("#claimMember").text("Es mi padre!");
		}
		updateContent(".modal-body","includes/person.php",{"uid": newUid, "person_type_id": person_type_id},before,complete);
	});
});