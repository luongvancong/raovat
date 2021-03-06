<?php

namespace Nht\Hocs\Posts;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
     protected $table = 'post_images';
     protected $fillable = ['image','post_id'];

     public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getPostId(){
        return $this->post_id;
    }

    public function setPostId($post_id){
        $this->post_id = $post_id;
    }

    public function post(){
        return $this->belongsTo('Nht\Hocs\Posts\Post', 'id', 'post_id');
    }
}
