<?php

namespace CollegeSocial\models;

use CollegeSocial\models\Status;
use URL;
use Cache;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\contracts\Auth\Authenticatable as AuthenticatableContract;

class user extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'users';

    protected $fillable = [
    	'username',
    	'email',
    	'password',
    	'first_name',
    	'last_name',
        'middle_name',
    	'location',
        'hometown',
        'year',
        'branch',
        'work',
        'course',
        'profile',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function getName()
    {
if($this->first_name && $this->last_name && $this->middle_name)
        {
            return "{$this->first_name} {$this->middle_name} {$this->last_name}";
        }
        
        if($this->first_name && $this->last_name)
        {
            return "{$this->first_name} {$this->last_name}";
        }
        
        if($this->first_name)
        {
            return $this->first_name;
        }
         return null;
    }

    public function getNameOrUsername()
    {
        if($this->isOnline()){
            return $this->getName() ?: $this->username;
        }
        return $this->getName() ?: $this->username;
    }

     public function getFirstNameOrUsername()
    {
        return $this->first_name ?: $this->username;
    }

    public function getAvatarUrl()
    {
        if($this->profile)
        {
            return URL::asset('storage/images/').'/'.$this->username.'/profile/thumb.'.$this->profile;
        }
        return URL::asset('storage/images/mm.png');
    }

    public function getAvatarUrlFull()
    {
        if($this->profile)
        {
            return URL::asset('storage/images/').'/'.$this->username.'/profile/'.$this->profile;
        }
        return "https://www.gravatar.com/avatar/{{ md5($this->email) }}?d=mm&size=50";
    }

    public function statuses()
    {
        return $this->hasMany('CollegeSocial\models\Status', 'user_id');
    }

    public function messages()
    {
        return $this->hasMany('CollegeSocial\models\messages', 'user_id');
    }

    public function likes()
    {
        return $this->hasMany('CollegeSocial\models\like', 'user_id');
    }

    public function images()
    {
        return $this->hasMany('CollegeSocial\models\images', 'user_id');
    }

    public function friendOfMine()
    {
        return $this->belongsToMany('CollegeSocial\models\user', 'friends', 'user_id', 'friend_id');
    }

    public function friendOf()
    {
        return $this->belongsToMany('CollegeSocial\models\user', 'friends', 'friend_id', 'user_id');
    }

    public function friends()
    {
        return $this->friendOfMine()->wherePivot('accepted', true)->get()->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }

    public function friendRequests()
    {
        return $this->friendOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsPending()
    {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user)
    {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user)
    {
        $this->friendOf()->attach($user->id);
    }

    public function deleteFriend(User $user)
    {
        $this->friendOf()->detach($user->id);
        $this->friendOfMine()->detach($user->id);
    }

    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
            'accepted' => true,
        ]);
    }

    public function isFriendsWith(User $user)
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

    public function hasLikedStatus(Status $status)
    {
        return (bool)$status->likes->where('user_id', $this->id)->count();
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    // user information lived worked and education

    public function lived()
    {
        return $this->hasMany('CollegeSocial\models\lived', 'user_id');
    }

    public function education()
    {
        return $this->hasMany('CollegeSocial\models\education', 'user_id');
    }

    public function worked()
    {
        return $this->hasMany('CollegeSocial\models\worked', 'user_id');
    }

    public function sender()
    {
        return $this->hasMany('CollegeSocial\models\sender', 'user_id');
    }

}
