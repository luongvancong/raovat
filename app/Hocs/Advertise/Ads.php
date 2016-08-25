<?php

namespace Nht\Hocs\Advertise;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model {
    public $table = 'ads';

    public function getId()
    {
    	return $this->id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getLink()
    {
    	return $this->link;
    }

    public function getBanner()
    {
    	return $this->banner;
    }

    public function getTitle()
    {
    	return $this->title;
    }

    public function getPosition()
    {
    	return $this->position;
    }

    public function getActive()
    {
    	return $this->active;
    }

    public function getUserName()
    {
    	return $this->name;
    }

    public function getUserEmail()
    {
        return $this->email;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getExpired()
    {
        return $this->expired;
    }

    public function users()
    {
    	return $this->hasOne('Nht\Hocs\Users\User', 'id');
    }

}
