function updateContent(selector,url,data,before,complete){
	$(selector).html("<div id='spinner'><i class='fa fa-spinner fa-spin fa-7x'></i></div>");
	before != "" ? before() : "";
	$.ajax({
		type: "GET",
		url: url,
		data: data,
		success: function(data){
			$(selector).html(data);
			complete != "" ? complete() : "";
		}
	});
}

var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();