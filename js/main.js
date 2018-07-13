$(document).ready(function(){
	var timeout = 0;
	$(document).on("click",".selectPerson",function(){
		var gender = $(this).data("gender");
		var search_term = $("#searchInput").val();
		$(".showUserSelect").show();
		var complete = function() {
			$("#selectPersonType").slideUp(500);
			$("#searchInput").attr("data-gender",gender);
		}
		updateContent("#results","includes/results.php",{"gender": gender, "search_term": search_term},"",complete,"");
	});
	$(document).on("click",".showUserSelect",function(){
		$("#selectPersonType").slideDown(500);
		$(this).hide();
	});
	$(document).on("click",".person, .child",function(){
		var child = $(this).hasClass("child");
		var uid = $(this).data("uid");
		var gender = $(this).data("gender");
		var name = $(this).data("fullname");
		var claim_type = "adult";
		child ? claim_type = "child" : "";
		var before = function(){
			$(".modal").modal("show");
		}
		var complete = function(){
			$(".modal-title").html(name + " <a id='uid' data-uid='"+uid+"' data-toggle='tooltip' data-placement='bottom' title='" + uid + "'><i class='far fa-id-badge fa-lg'></i></a>");
			if(child){
				$("#modalSubmit").text("¡Este soy yo!");
			}
			else {
				gender == "m" ? $("#modalSubmit").text("¡Es mi Papa!") : $("#modalSubmit").text("¡Es mi Mama!");
			}
			
		}
		var modalsubmit = function(){
			$.ajax({
				type: "GET",
				url: "processclaim.php",
				data: {"uid": uid, "claim_type": claim_type},
				success: function(data){
					if(child){
						window.location.href = "index.php";
					}
					else {
						window.location.href = "claim_success.php?uid="+uid;
					}
				}
			});
		}
		updateContent(".modal-body","includes/person.php",{"uid": uid, "gender": gender},before,complete,modalsubmit);
	});
	$(document).on("keyup","#searchInput",function(){
		clearTimeout(timeout);
		timeout = setTimeout(function(){
			var gender = $("#searchInput").data("gender");
			$(".showUserSelect").show();
			var complete = function() {
				$("#selectPersonType").slideUp(500);
			}
			updateContent("#results","includes/results.php",{"gender": gender, "search_term": $("#searchInput").val()},"",complete,"");
		},1000);
		
	});
	$(document).on("click",".previewMatch",function(){
		var match_id = $(this).data("match_id");
		var uid_a = $(this).data("uid_a");
		var uid_b = $(this).data("uid_b");
		var before = function(){
			$(".modal").modal("show");
			$("#modalSubmit").hide();
		}
		var complete = function(){
			$(".modal-title").html("Match ID: " + match_id);
		}
		updateContent(".modal-body","match_info.php",{"uid_a": uid_a, "uid_b": uid_b},before,complete,"");
	});
	$(document).on("click",".editTicket",function(){
		var ticket_id = $(this).data("ticket_id");
		var before = function(){
			$(".modal").modal("show");
			$("#modalSubmit").show();
		}
		var complete = function(){
			$(".modal-title").html("Ticket No. " + ticket_id);
			$("#modalSubmit").text("Update Ticket");
		}
		var modalsubmit = function(){
			alert("ticket edit submitted");
		}
		updateContent(".modal-body","manage_ticket.php",{"ticket_id": ticket_id},before,complete,modalsubmit);
	});
	$(document).on("click",".editFacility",function(){
		var facility_name = $(this).data("facility_name");
		var before = function(){
			$(".modal").modal("show");
			$("#modalSubmit").show();
		}
		var complete = function(){
			$(".modal-title").html("Facility Name: " + facility_name);
			$("#modalSubmit").text("Update Facility");
		}
		var modalsubmit = function(){
			alert("facility edit submitted");
		}
		updateContent(".modal-body","manage_facility.php",{"facility_name": facility_name},before,complete,"");
	});
});