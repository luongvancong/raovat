<?php

namespace Nht\Hocs\Advertise;

use Illuminate\Database\Eloquent\Model;

class AdsRegister extends Model
{

    public $table = 'ads_register';

    public function getId()
    {
    	return $this->id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getName()
    {
    	return $this->name;
    }

    public function getPhone()
    {
    	return $this->phone;
    }

    public function getEmail()
    {
    	return $this->email;
    }

    public function getContent()
    {
    	return $this->content;
    }
    
}
