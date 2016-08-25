<?php

namespace Nht\Hocs\Users;

use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, EntrustUserTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'password', 'name', 'nickname', 'phone', 'address', 'avatar', 'gender'];

    protected $guarded = ['roles'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function getName()
    {
        return $this->name;
    }

    public function getUrl()
    {
        return route('account.profile');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSlug()
    {
        return removeTitle($this->name);
    }

    public function getImage($type = 'sm_')
    {
        if(is_file(PATH_UPLOAD_USER_AVATAR . $type . $this->avatar)) {
            return PATH_USER_AVATAR . $type . $this->avatar;
        }

        return '/images/grey.gif';
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getShopId()
    {
        return $this->shop_id;
    }

}
