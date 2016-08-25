<?php

namespace Nht\Hocs\Products;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public $timestamp = false;
    protected $guarded = array('id');

    protected $PATH_STATIC = '/';

    public function getId()
    {
        return $this->id;
    }

    public function getImage($type = 'thumbs/big', $thumb = 'xlg_')
    {
        if($this->isCrawl()) {
            return $this->PATH_STATIC . 'uploads/' . $type . '/' . $this->image;
        }

        return $this->PATH_STATIC . 'uploads/products/' . $thumb . $this->image;
    }

    public function getKeyword()
    {
        return $this->keyword ? $this->keyword : $this->getName();
    }

    public function getArrayKeyword()
    {
        return explode(',', $this->keyword);
    }

    public function getIgnoreKeyword() {
        return $this->ignore_keyword;
    }

    public function getArrayIgnoreKeyword() {
        return explode(',', $this->getIgnoreKeyword());
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSlug()
    {
        return removeTitle($this->getName());
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getMinPrice()
    {
        return $this->min_price;
    }

    public function getAvgPrice()
    {
        return $this->avg_price;
    }

    public function getUrl()
    {
        return route('product.detail', array(
            $this->getId(),
            $this->getSlug()
        ));
    }

    public function getSpec()
    {
        $spec = $this->spec;
        $spec = preg_replace("/<a\s(.+?)>(.+?)<\/a>/is", "<span>$2</span>", $spec);
        return $spec;
    }

    public function getImages($type = 'full')
    {
        $imagesReturn = array();

        if($this->images) {
            $images = explode(',', $this->images);
            foreach ($images as $image) {
                array_push($imagesReturn, PATH_STATIC . 'uploads/' . $type . '/' . $image);
            }
        }

        return $imagesReturn;
    }

    public function getMetaTitle()
    {
        return $this->meta_title;
    }

    public function getMetaKeyword()
    {
        return $this->meta_keyword;
    }

    public function getMetaDescription()
    {
        return $this->meta_description;
    }

    public function getPostKeyword()
    {
        return $this->post_keyword;
    }

    public function getRateKeyword()
    {
        return $this->rate_keyword;
    }

    public function getVideoKeyword()
    {
        return $this->video_keyword;
    }


    public function getTotalShop()
    {
        return $this->total_shop;
    }

    public function getTotalShopUpdate()
    {
        return $this->total_shop_update;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function getArrayTags()
    {
        $tags = explode(',', $this->tags);
        return $tags;
    }

    public function hasTags()
    {
        return $this->tags ? true : false;
    }


    public function isNew()
    {
        return $this->new ? true : false;
    }

    public function getView()
    {
        return $this->views;
    }

    public function setView($view)
    {
        $this->views = $view;
    }


    public function setRatingCount($c) {
        $this->rating_count = $c;
    }

    public function setCommentCount($c)
    {
        $this->comment_count = $c;
    }

    public function setQuestionCount($c)
    {
        $this->question_count = $c;
    }

    public function setClassifieldCount($c)
    {
        $this->classifield_count = $c;
    }

    public function setVideoCount($c) {
        $this->video_count = $c;
    }

    public function setPostCount($c) {
        $this->post_count = $c;
    }

    public function getRatingCount()
    {
        return (int) $this->rating_count;
    }

    public function getCommentCount()
    {
        return (int) $this->comment_count;
    }

    public function getQuestionCount() {
        return (int) $this->question_count;
    }

    public function getRaovatCount() {
        return (int) $this->classifield_count;
    }

    public function getVideoCount() {
        return (int) $this->video_count;
    }

    public function getPostCount() {
        return (int) $this->post_count;
    }

    public function getClickShopCount()
    {
        return (int) $this->click_to_shop_count;
    }

    public function presenter() {
        return new Presenter($this);
    }

    public function tags()
    {
        return $this->belongsToMany('Nht\Hocs\Tags\Tag', 'products_tags');
    }
}

