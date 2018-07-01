$(document).ready(function(){
	$(document).on("click",".selectPerson",function(){
		var person_type_id = $(this).attr("data-person_type_id");
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
});