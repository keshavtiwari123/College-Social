$(document).ready(function(){
		$("#search").hide();
})
$('#search-btn').click(function(){
	$(".icon-bar").hide();
	$("#search").show();
});

$(".container").click(function(){
	$(".icon-bar").show();
	$("#search").hide();
})