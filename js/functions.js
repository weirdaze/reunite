function updateContent(selector,url,data,before,complete,modalsubmit){
	$(selector).html("<div id='spinner'><i class='fa fa-spinner fa-spin fa-7x'></i></div>");
	before != "" ? before() : "";
	$.ajax({
		type: "GET",
		url: url,
		data: data,
		success: function(data){
			$(selector).html(data);
			complete != "" ? complete() : "";
			if(modalsubmit != ""){
				$("#modalSubmit").unbind("click");
				$("#modalSubmit").click(function(){
					modalsubmit();
				});
			}
		}
	});
}