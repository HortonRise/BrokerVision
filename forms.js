function newBid() {
  var formData = $("#newBid").serializeArray();
  $("#newBidForm").hide();
  $("#loadingBid").show();
  $.post( "/auction/newbid", formData ,function( data ) {
    $("#newBidForm").show();
    $("#loadingBid").hide();
    console.log(data);
  });
}
