$(document).ready(function(){
	$(document).on("click",".selectPerson",function(){
		var gender = $(this).data("gender");
		$(".showUserSelect").show();
		var complete = function() {
			$("#selectPersonType").slideUp(500);
		}
		updateContent("#results","includes/results.php",{"gender": gender},"",complete);
	});
	$(document).on("click",".showUserSelect",function(){
		$("#selectPersonType").slideDown(500);
		$(this).hide();
	});
	$(document).on("click",".person",function(){
		var uid = $(this).data("uid");
		var gender = $(this).data("gender");
		var name = $(this).data("fullname");
		var before = function(){
			$(".modal").modal("show");
		}
		var complete = function(){
			$(".modal-title").text(name + " (UID: "+uid+")");
			gender == "male" ? $("#claimMember").text("Es mi Papa!") : $("#claimMember").text("Es mi Mma!");
		}
		updateContent(".modal-body","includes/person.php",{"uid": uid, "gender": gender},before,complete);
	});
	$(document).on("click",".prevArrow, .nextArrow",function(){
		var uid = $("#personDetails").data("uid");
		var gender = $("#personDetails").data("gender");
		var direction = 1;
		$(this).hasClass("prevArrow") ? direction = -1 : "";
		var newUid = uid + direction;
		var before = function(){
			$(".modal-title").text("");
		}
		var complete = function(){
			$(".modal-title").text("Juan Doe (UID: "+newUid+")");
			gender == 1 ? $("#claimMember").text("Es mi hijo!") : $("#claimMember").text("Es mi padre!");
		}
		updateContent(".modal-body","includes/person.php",{"uid": newUid, "gender": gender},before,complete);
	});
});