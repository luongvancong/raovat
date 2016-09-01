<?php

namespace Nht\Hocs\Cities;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $primaryKey = 'cit_id';
    public $timestamps    = false;

    public function getId() {
        return $this->cit_id;
    }

    public function setId($id) {
        $this->cit_id = $id;
    }

    public function setName($name) {
        $this->cit_name = $name;
    }

    public function getName() {
        return $this->cit_name;
    }

    public function setCity_Parent($cit_parent) {
        $this->cit_parent = $cit_parent;
    }

    public function getCity_Parent() {
        return $this->cit_parent;
    }

    public function getChild(){
        return $this->hasMany('Nht\Hocs\Cities\City', 'cit_parent','cit_id');
    }
    public function getParent(){
        return $this->hasOne('Nht\Hocs\Cities\City', 'cit_id', 'cit_parent');
    }

}
