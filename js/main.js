$(document).ready(function(){
	var timeout = 0;
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
			$(".modal-title").html(name + " <a id='uid' data-toggle='tooltip' data-placement='bottom' title='" + uid + "'><i class='far fa-id-badge fa-lg'></i></a>");
			gender == "m" ? $("#claimMember").text("Es mi Papa!") : $("#claimMember").text("Es mi Mama!");
		}
		updateContent(".modal-body","includes/person.php",{"uid": uid, "gender": gender},before,complete);
	});
	$(document).on("keyup","#searchInput",function(){
		clearTimeout(timeout);
		timeout = setTimeout(function(){
			var complete = function() {
				$("#selectPersonType").slideUp(500);
			}
			updateContent("#results","includes/results.php",{"gender": "1", "search_term": $("#searchInput").val()},"",complete);
		},1000);
		
	});
	/*$(document).on("click",".prevArrow, .nextArrow",function(){
		var uid = $("#personDetails").data("uid");
		var gender = $("#personDetails").data("gender");
		var direction = 1;
		$(this).hasClass("prevArrow") ? direction = -1 : "";
		var newUid = uid + direction;
		var before = function(){
			$(".modal-title").text("");
		}
		var complete = function(){
			$(".modal-title").text("Juan Doe <span class='small'>(UID: "+newUid+")</span>");
			gender == 1 ? $("#claimMember").text("Es mi hijo!") : $("#claimMember").text("Es mi padre!");
		}
		updateContent(".modal-body","includes/person.php",{"uid": newUid, "gender": gender},before,complete);
	});*/
});