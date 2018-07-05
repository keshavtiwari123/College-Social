// liking a post -->

function like(like_id, address)
		{
			$.ajax({
					type: 'get',
					url: address,
					success: function(){
						$('#like'+like_id).load(document.URL +  ' #like'+like_id);
					}
				});
		}

// add friend or accept friend request -->
function add(username)
{
	$.ajax({
		type: 'get',
		data: 'username ='+username,
		url: '/friends/add/'+username,
		success: function(){
						$('#addFriend'+username).load(document.URL +  ' #addFriend'+username);	
						}
	});
}

function accept(username)
{
	$.ajax({
		type: 'get',
		data: 'username ='+username,
		url: '/friends/accept/'+username,
		success: function(){
						$('#addFriend'+username).load(document.URL +  ' #addFriend'+username);	
						}
	});
}

// those three dots in every post are hidden and shown -->

var hidden = 1;
function showsettings(id){
	if(hidden == 1)
	{
		$("#hiddenSettings"+id).show();
		hidden = 0;
	}
	else
	{
		$("#hiddenSettings"+id).hide();
		hidden = 1;
	}
}

// click to read more

function showPost(id){
	$("#status-body-full"+id).show();
	$("#status-body-less"+id).hide();
	$("#read-more"+id).hide();
}

// below code manages the edit delete and report functionality of the statuses  -->

$("#edit, #delete, #report").mouseover(function(){
	$(this).css('background-color', '#3bbced').css('border', '1px solid #3bbced').css('border-radius', '4px').css('padding', '2px').css('text-decoration', 'none').css('width', '100%');
}).mouseout(function(){
	$(this).css('background-color', 'white').css('border', 'none').css('border-radius', 'none');
});

// code below manages the styling of alert template

$("#alert").mousemove(function (e) {
	var hovertext = $(this).attr("hovertext");
	$("#hoverdiv").html(hovertext).show();
	$("#hoverdiv").css("top", e.clientY+10).css("left", e.clientX+10);
}).mouseout(function() {
	$("#hoverdiv").hide();
}).click(function(){
	$("#alert").hide();
	$("#hoverdiv").hide();
});