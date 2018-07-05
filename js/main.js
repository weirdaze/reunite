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
		updateContent("#results","includes/results.php",{"gender": gender, "search_term": search_term},"",complete);
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
		var before = function(){
			$(".modal").modal("show");
		}
		var complete = function(){
			$(".modal-title").html(name + " <a id='uid' data-uid='"+uid+"' data-toggle='tooltip' data-placement='bottom' title='" + uid + "'><i class='far fa-id-badge fa-lg'></i></a>");
			if(child){
				$("#claimMember").attr("data-claim_type","child").text("¡Este soy yo!");
			}
			else {
				gender == "m" ? $("#claimMember").text("¡Es mi Papa!") : $("#claimMember").text("¡Es mi Mama!");
			}
			
		}
		updateContent(".modal-body","includes/person.php",{"uid": uid, "gender": gender},before,complete);
	});
	$(document).on("keyup","#searchInput",function(){
		clearTimeout(timeout);
		timeout = setTimeout(function(){
			var gender = $("#searchInput").data("gender");
			$(".showUserSelect").show();
			var complete = function() {
				$("#selectPersonType").slideUp(500);
			}
			updateContent("#results","includes/results.php",{"gender": gender, "search_term": $("#searchInput").val()},"",complete);
		},1000);
		
	});
	$(document).on("click","#claimMember",function(){
		if($(this).data("claim_type") == "child"){
			var uid = $("#uid").data("uid");
			$.ajax({
				type: "GET",
				url: "processclaim",
				data: {"uid": uid},
				success: function(data){
					$("body").html(data);
				}
			});
		}
	});
});