<?php

namespace Nht\Hocs\Posts;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model {
    protected $table = 'post_comments';

    public function getUserAvatar() {
        return PATH_STATIC . 'uploads/thumbs/big/' . $this->user_avatar;
    }

    public function getUserName() {
        return $this->user_name;
    }

    public function getComment() {
        return $this->comment;
    }
}