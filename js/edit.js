



$("#Edit").submit(function(e){
	e.preventDefault();
	var form = $(this);
	var post_url = form.attr("action");
	var post_data = form.serialize();
	$.ajax({

		type: "POST",
		url: post_url,
		data: post_data,
		cache: false,
	
		success: function(info){
			
		$("#result").html(info);
		

}
	});



});
