<div id="addFriend{{$user->username}}"> 
			@if (Auth::user()->hasFriendRequestPending($user))
				<p>Waiting for {{$user->getNameOrUsername()}} to accept your friend request</p>
			@elseif (Auth::user()->hasFriendRequestReceived($user))
				<div class="btn btn-primary" onclick="accept('{{$user->username}}')" >
					Accept {{ $user->getFirstNameOrUsername() }}`s friend request
				</div>
			@elseif (Auth::user()->isFriendsWith($user))
				<p>you and {{$user->getNameOrUsername() }} are friends</p>
					
			@elseif(Auth::user()->id != $user->id)
			<div class="btn btn-primary" onclick="add('{{$user->username}}')" >
				Add {{ $user->getFirstNameOrUsername() }} as friends
			</div>		
			@endif
</div>			