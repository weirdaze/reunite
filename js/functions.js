function updateContent(selector,url,data,action,before,complete,modalsubmit){
	switch(action){
		case "append":
			$(selector).append("<div id='spinner'><i class='fa fa-spinner fa-spin fa-7x'></i></div>");
			break;
		case "prepend":
			$(selector).prepend("<div id='spinner'><i class='fa fa-spinner fa-spin fa-7x'></i></div>");
			break;
		case "overwrite":
			$(selector).html("<div id='spinner'><i class='fa fa-spinner fa-spin fa-7x'></i></div>");
			break;
	}
	
	before != "" ? before() : "";
	$.ajax({
		type: "GET",
		url: url,
		data: data,
		success: function(data){
			switch(action){
				case "append":
					$("#spinner").remove();
					$(selector).append(data);
					break;
				case "prepend":
					$("#spinner").remove();
					$(selector).prepend(data);
					break;
				case "overwrite":
					$(selector).html(data);
					break;
			}
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