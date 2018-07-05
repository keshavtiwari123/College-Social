<?php

Route::get('/', [
	'uses' => '\CollegeSocial\Http\Controllers\HomeController@index',
	'as' => 'home',
]);

Route::get('/alert', function()
{
	return redirect()->route('home')->with('info', 'you have now signed in');
});

Route::get('/signup', [
	'uses' => '\CollegeSocial\Http\Controllers\AuthController@getSignup',
	'as' => 'auth.signup',
	'middleware' => ['guest'],
]);

Route::post('/signup', [
	'uses' => '\CollegeSocial\Http\Controllers\AuthController@postSignup',
	'middleware' => ['guest'],
]);

Route::get('/signin', [
	'uses' => '\CollegeSocial\Http\Controllers\AuthController@getSignin',
	'as' => 'auth.signin',
	'middleware' => ['guest'],
]);

Route::post('/signin', [
	'uses' => '\CollegeSocial\Http\Controllers\AuthController@postSignin',
	'middleware' => ['guest'],
]);

Route::get('/signout', [
	'uses' => '\CollegeSocial\Http\Controllers\AuthController@getSignout',
	'as' => 'auth.signout',
]);

/*
* SEARCH BELOW THIS
*/

Route::get('/search', [
	'uses' => '\CollegeSocial\Http\Controllers\SearchController@getResult',
	'as' => 'search.results',
]);

/*
* USER PROFILE BELOW THIS
*/

Route::get('/user{username}', [
	'uses' => '\CollegeSocial\Http\Controllers\ProfileController@getProfile',
	'as' => 'profile.index',
]);

Route::get('/profile/edit', [
	'uses' => '\CollegeSocial\Http\Controllers\ProfileController@getEdit',
	'as' => 'profile.edit',
	'middleware' => ['auth'],
]);

Route::post('/profile/edit', [
	'uses' => '\CollegeSocial\Http\Controllers\ProfileController@postEdit',
	'as' => 'profile.edit',
	'middleware' => ['auth'],
]);

Route::post('/profile/edit/image', [
	'uses' => '\CollegeSocial\Http\Controllers\ProfileController@postEditImage',
	'as' => 'profile.edit.image',
	'middleware' => ['auth'],
]);

Route::get('/user/{username}/about', [
	'uses' => '\CollegeSocial\Http\Controllers\ProfileController@getAbout',
	'as' => 'user.about',
	'middleware' => ['auth'],
]);

/*
* Friends
*/
Route::get('/friends', [
	'uses' => '\CollegeSocial\Http\Controllers\FriendController@getIndex',
	'as' => 'friends.index',
	'middleware' => ['auth'],
]);

Route::get('/user/{username}/classmates', [
	'uses' => '\CollegeSocial\Http\Controllers\FriendController@getClassmates',
	'as' => 'user.classmates',
	'middleware' => ['auth'],
]);

Route::get('/user/{username}/batchmates', [
	'uses' => '\CollegeSocial\Http\Controllers\FriendController@getBatchmates',
	'as' => 'user.batchmates',
	'middleware' => ['auth'],
]);

Route::get('/user/{username}/colleagues', [
	'uses' => '\CollegeSocial\Http\Controllers\FriendController@getColleagues',
	'as' => 'user.colleagues',
	'middleware' => ['auth'],
]);

Route::get('/user/{username}/friends', [
	'uses' => '\CollegeSocial\Http\Controllers\FriendController@getfriends',
	'as' => 'user.friends',
	'middleware' => ['auth'],
]);

Route::get('/friends/add/{username}', [
	'uses' => '\CollegeSocial\Http\Controllers\FriendController@getAdd',
	'as' => 'friends.add',
	'middleware' => ['auth'],
]);

Route::post('/friends/delete/{username}', [
	'uses' => '\CollegeSocial\Http\Controllers\FriendController@postDelete',
	'as' => 'friend.delete',
	'middleware' => ['auth'],
]);

Route::get('/friends/accept/{username}', [
	'uses' => '\CollegeSocial\Http\Controllers\FriendController@getAccept',
	'as' => 'friends.accept',
	'middleware' => ['auth'],
]);

/*
* STATUSES
*/

Route::post('/status', [
	'uses' => '\CollegeSocial\Http\Controllers\StatusController@postStatus',
	'as' => 'status.post',
	'middleware' => ['auth'],
]);

Route::post('/status/edit/{statusId}', [
	'uses' => '\CollegeSocial\Http\Controllers\StatusController@postStatusEdit',
	'as' => 'status.post.edit',
	'middleware' => ['auth'],
]);

Route::post('/status/{statusId}/reply', [
	'uses' => '\CollegeSocial\Http\Controllers\StatusController@postReply',
	'as' => 'status.reply',
	'middleware' => ['auth'],
]);

Route::get('/status/{statusId}/like', [
	'uses' => '\CollegeSocial\Http\Controllers\StatusController@getLike',
	'as' => 'status.like',
	'middleware' => ['auth'],
]);

Route::get('/status/{statusId}/likes', [
	'uses' => '\CollegeSocial\Http\Controllers\StatusController@getLikeList',
	'as' => 'like.list',
	'middleware' => ['auth'],
]);

Route::get('/status/{statusId}/Comment', [
	'uses' => '\CollegeSocial\Http\Controllers\StatusController@getComment',
	'as' => 'status.Comment',
	'middleware' => ['auth'],
]);

Route::get('/status/{statusId}/Edit/review', [
	'uses' => '\CollegeSocial\Http\Controllers\StatusController@getEdit',
	'as' => 'status.Edit',
	'middleware' => ['auth'],
]);

Route::get('/status/{statusId}/Delete', [
	'uses' => '\CollegeSocial\Http\Controllers\StatusController@getDelete',
	'as' => 'status.Delete',
	'middleware' => ['auth'],
]);

Route::get('/status/{statusId}/{imageId}/Delete/img', [
	'uses' => '\CollegeSocial\Http\Controllers\StatusController@getDeleteImage',
	'as' => 'status.Delete.image',
	'middleware' => ['auth'],
]);

Route::get('/status/{likeId}/Delete', [
	'uses' => '\CollegeSocial\Http\Controllers\StatusController@getDeletelike',
	'as' => 'Delete.like',
	'middleware' => ['auth'],
]);

// trying ajax

Route::get('/test', [
	'uses' => '\CollegeSocial\Http\Controllers\HomeController@ajax',
]);


// Image Manipulation

Route::get('resizeImage', 'ImageController@resizeImage');

Route::post('resizeImagePost',[
	'as'=>'resizeImagePost',
	'uses'=>'ImageController@resizeImagePost'
]);

//messages

Route::get('/messages', [
	'uses' => '\CollegeSocial\Http\Controllers\MessageController@getIndexMobile',
	'as' => 'messages.mobile',
	'middleware' => ['auth'],
]);

Route::get('/messages', [
	'uses' => '\CollegeSocial\Http\Controllers\MessageController@getIndexDesktop',
	'as' => 'messages.desktop',
	'middleware' => ['auth'],
]);

Route::get('/messages/blablabla/{senderId}', [
	'uses' => '\CollegeSocial\Http\Controllers\MessageController@getMessagesDesktop',
	'as' => 'messages.messages',
	'middleware' => ['auth'],
]);

Route::post('/message/send/{senderId}', [
	'uses' => '\CollegeSocial\Http\Controllers\MessageController@sendMessages',
	'as' => 'message.send',
	'middleware' => ['auth'],
]);

// settings
Route::post('/work/add', [
	'uses' => '\CollegeSocial\Http\Controllers\UserDataController@addWork',
	'as' => 'work.add',
	'middleware' => ['auth'],
]);

Route::get('del/work/{workId}', [
	'uses' => '\CollegeSocial\Http\Controllers\UserDataController@deleteWork',
	'as' => 'work.delete',
	'middleware' => ['auth'],
]);

Route::post('edt/work/{workId}', [
	'uses' => '\CollegeSocial\Http\Controllers\UserDataController@editWork',
	'as' => 'work.edit',
	'middleware' => ['auth'],
]);


Route::post('/education/add', [
	'uses' => '\CollegeSocial\Http\Controllers\UserDataController@addEducation',
	'as' => 'education.add',
	'middleware' => ['auth'],
]);


Route::get('del/education/{educationId}', [
	'uses' => '\CollegeSocial\Http\Controllers\UserDataController@deleteEducation',
	'as' => 'education.delete',
	'middleware' => ['auth'],
]);

Route::post('edt/education/{educationId}', [
	'uses' => '\CollegeSocial\Http\Controllers\UserDataController@editeducation',
	'as' => 'education.edit',
	'middleware' => ['auth'],
]);


Route::post('/lived/add', [
	'uses' => '\CollegeSocial\Http\Controllers\UserDataController@addLived',
	'as' => 'lived.add',
	'middleware' => ['auth'],
]);

Route::get('del/lived/{livedId}', [
	'uses' => '\CollegeSocial\Http\Controllers\UserDataController@deleteLived',
	'as' => 'lived.delete',
	'middleware' => ['auth'],
]);

Route::post('edt/lived/{livedId}', [
	'uses' => '\CollegeSocial\Http\Controllers\UserDataController@editLived',
	'as' => 'lived.edit',
	'middleware' => ['auth'],
]);
