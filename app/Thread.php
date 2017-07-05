<?php

namespace App;

use App\Filters\ThreadFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class Thread extends Model
{
    protected $guarded = [];


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
        });
    }
    
    public function path()
    {
    	return '/threads/' . $this->channel->slug . '/' . $this->id;
     
    }

    /**
     * A thread has many replies
     * 
     */
    public function replies()
    {
    	return $this->hasMany(Reply::class);
    }

    /**
     * A thread belongs to a creator
     */
    public function creator()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A thread can add reply
     * @param $reply 
     */
    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }

    /**
     * A thread belongs to a specific channel
     * 
     */
    public function channel(){
        
        return $this->belongsTo(Channel::class);

    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

}
