
$("#Edit").submit(function (e) {
  e.preventDefault();
  var form = $(this);
  var post_url = form.attr("action");
  var post_data = form.serialize();


  $.ajax({
    type: "post",
    url: post_url,
    data: post_data,
    cache: false,
    // error: function(a,b,c){
    // 	alert(c);
    // },
    success: function (info) {
      $("#result").html(info);
    }

  });

});
