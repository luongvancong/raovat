<?php namespace Nht\Hocs\Tags;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    const POSITION_HEADER = 1;
    const POSITION_FOOTER = 2;

    protected $guarded = ['id'];

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getSlug()
    {
        return $this->slug ? $this->slug : removeTitle($this->getName());
    }

    public function getMeta($key)
    {
        return $this->{'meta_' . $key};
    }

    public function getUrl()
    {
        return route('tag.index', $this->name);
    }

    public function products() {
        return $this->belongsToMany('Nht\Hocs\Products\Product', 'products_tags', 'tag_id', 'product_id');
    }

    public function posts()
    {
        return $this->belongsToMany('Nht\Hocs\Posts\Post', 'posts_tags', 'tag_id', 'post_id');
    }

    public function videos()
    {
        return $this->belongsToMany('Nht\Hocs\ProductVideos\ProductVideo', 'videos_tags', 'tag_id', 'video_id');
    }
}