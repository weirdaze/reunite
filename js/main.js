$(document).ready(function(){
	var timeout = 0;
	//load results based on gender
	$(document).on("click",".selectPerson",function(){
		var gender = $(this).data("gender");
		var search_term = $("#searchInput").val();
		$(".showUserSelect").show();
		var complete = function() {
			$("#selectPersonType").slideUp(500);
			$("#searchInput").attr("data-gender",gender);
		}
		updateContent("#results","includes/results.php",{"gender": gender, "search_term": search_term},"overwrite","",complete,"");
	});
	//show the gender options
	$(document).on("click",".showUserSelect",function(){
		$("#selectPersonType").slideDown(500);
		$(this).hide();
	});
	//open modal to view additional information about a child or adult and claim as self or parent
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
		updateContent(".modal-body","includes/person.php",{"uid": uid, "gender": gender},"overwrite",before,complete,modalsubmit);
	});
	//reload results based on search
	$(document).on("keyup","#searchInput",function(){
		clearTimeout(timeout);
		timeout = setTimeout(function(){
			var gender = $("#searchInput").attr("data-gender");
			$(".showUserSelect").show();
			var complete = function() {
				$("#selectPersonType").slideUp(500);
			}
			updateContent("#results","includes/results.php",{"gender": gender, "search_term": $("#searchInput").val()},"overwrite","",complete,"");
		},1000);
	});
	//append more results
	$(document).on("click","#loadMore",function(){
		var gender = $("#searchInput").attr("data-gender");
		var page = $(this).attr("data-page");
		$(this).remove();
		updateContent("#results","includes/results.php",{"gender": gender, "search_term": $("#searchInput").val(), "page": page},"append","","","");
	});
	//open modal to preview a match
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
		updateContent(".modal-body","match_info.php",{"uid_a": uid_a, "uid_b": uid_b},"overwrite",before,complete,"");
	});
	//open modal dialog and reload display_tickets to reflect any changes made in dialog
	$(document).on("click",".editTicket",function(){
		var ticket_id = $(this).data("ticket_id");
		var before = function(){
			$(".modal").modal("show");
			$("#modalSubmit").show();
		}
		var complete = function(){
			$(".modal-title").html("Ticket No. " + ticket_id);
			$("#modalSubmit").text("Done");
			$("#modalBack").hide();
		}
		var modalsubmit = function(){
			var ticket_number = $("#ticketNo").data("ticket_number");
			var update = $("#updates").val();
			/*console.log(update);*/
			$.post("update_ticket_status.php",{"ticket_number": ticket_number, "update": update},function(){
				window.location.href = "display_tickets.php";
			});
		}
		updateContent(".modal-body","manage_ticket.php",{"ticket_id": ticket_id},"overwrite",before,complete,modalsubmit);
	});
	//open modal dialog and update facility info
	$(document).on("click",".editFacility",function(){
		var facility_name = $(this).data("facility_name");
		var before = function(){
			$(".modal").modal("show");
			$("#modalSubmit").show();
		}
		var complete = function(){
			$(".modal-title").html("Facility Name: " + facility_name);
			$("#modalSubmit").text("Use button above");
		}
		var modalsubmit = function(){
			alert("facility edit submitted");
		}
		updateContent(".modal-body","manage_facility.php",{"facility_name": facility_name},"overwrite",before,complete,modalsubmit);
	});
	//change status to selected dropdown item
	$(document).on("click",".changeStatus",function(){
		var status = $(this).data("status");
		var ticket_number = $("#ticketNo").data("ticket_number");
		$.post("change_ticket_status.php",{"status": status, "ticket_number": ticket_number},function(){
			$("#changeStatus").text("Status: " + status);
		});
	});
	//change agent assignment to current userid
	$(document).on("click","#assignMe",function(){
		var userid = $("#assignMe").data("userid");
		var ticket_number = $("#ticketNo").data("ticket_number");
		$.post("change_ticket_agent.php",{"ticket_number": ticket_number},function(){
			$("#changeAgent").text("Assigned to: " + userid);
		});
	});
	//update ticket history and save notes on button click
	$(document).on("click","#saveNotes",function(){
		var ticket_number = $("#ticketNo").data("ticket_number");
		var update = $("#updates").val();
		$("#ticketHistory").html("<div class='d-flex align-items-center justify-content-center'><i class='fa fa-spinner fa-spin fa-3x mt-3'></i></div>");
		$.get("includes/tickethistory.php",{"ticket_number": ticket_number, "update_notes": "1", "update": update},function(data){
			// console.log(data);
			$("#ticketHistory").html(data);
			$("#updates").val("");
		});
	});
	//update matches or tickets table with selected page
	$(document).on("click","#matchesPagination .page-link, #ticketsPagination .page-link",function(e){
		e.preventDefault();

		var item = $(this).parent();
		var container = item.parents("nav");
		var page = 1;

		if(item.is("#prevPage,#nextPage")){
			var currPage = parseInt($(".page-item.active").attr("data-page"));
			item.is("#prevPage") ? page = currPage - 1 : page = currPage + 1;
		}
		else {
			page = $(this).parent().attr("data-page");
		}

		/*console.log(currPage);*/
		
		var totalPages = container.data("total");

		var complete = function(){
			$(".page-item").removeClass("active");
			$(".page-item[data-page='"+page+"']").addClass("active");
			if(totalPages != 1){
				if(page == 1){
					$("#prevPage").addClass("disabled");
					$("#nextPage").removeClass("disabled");
				}
				else if(page == totalPages){
					$("#nextPage").addClass("disabled");
					$("#prevPage").removeClass("disabled");
				}
				else {
					$("#nextPage, #prevPage").removeClass("disabled");
				}
			}
			else {
				$("#prevPage, #nextPage").addClass("disabled");
			}
			
		}
		if(container.is("#matchesPagination")){
			updateContent("#matches","includes/matches.php",{"page": page},"overwrite","",complete,"");
		}
		else {
			var assigned_to = container.attr("data-assigned_to");
			updateContent("#tickets","includes/tickets.php",{"page": page, "assigned_to": assigned_to},"overwrite","",complete,"");
		}
	});
});