<?php

namespace Nht\Hocs\Posts;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $primaryKey = 'id';

	public $fillable = ['title', 'content', 'slug', 'category_id', 'user_id', 'active', 'hot'];

	protected $PATH_STATIC = '/';

	public function getId() {
		return $this->id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getSlug() {
		return removeTitle($this->getTitle());
	}

	public function getTeaser() {
		if(trim($this->teaser) && mb_strlen($this->teaser) >= 150) {
			return $this->teaser;
		}
		return cutString(strip_tags($this->getContent()), 250);
	}

	public function getContent() {
		$content = $this->content;
		return $content;
	}

	public function getSource() {
		$url    = parse_url($this->link);
		$domain = array_get($url, 'host');

		if($domain) {
			$first = substr($domain, 0, 1);
			return strtoupper($first) . substr($domain, 1, strlen($domain));
		}

		return $this->link;
	}

	public function getUrl() {
		return route('post.detail', [ $this->getId(), $this->getSlug() ]);
	}


	public function getImage($type = 'thumbs/big') {
		return $this->PATH_STATIC . 'uploads/' . $type . '/' . $this->avatar;;
	}

	public function getCategory() {
		$category    = trim($this->category);
		$firstLetter = mb_substr($category, 0, 1);
		return strtoupper($firstLetter) . mb_substr($category, 1, mb_strlen($category));
	}

	public function getCategoryId()
	{
		return $this->category_id;
	}

	public function getUpdatedAt() {
		return $this->updated_at;
	}

	public function getUpdatedAtStr() {
		return date('d/m/Y', strtotime($this->getUpdatedAt()));
	}

	public function getDateTimeIso8601() {
		$datetime = new \DateTime($this->updated_at);
		return $datetime->format(\DateTime::ISO8601);
	}

	public function getImageFromContent() {
		$content = $this->content;
		preg_match_all('#src="([^"]+)"#', $content, $matches);
		if(isset($matches[1])) {
			foreach($matches[1] as $imageLink) {
				if(getimagesize($imageLink) != false) {
					return $imageLink;
				}
			}
		}else {
			return PATH_STATIC . 'images/post_default_image.jpg';
		}
	}


	public function getTags()
	{
		return $this->tags;
	}

	public function getArrayTags()
	{
		return explode(',', $this->tags);
	}

	public function hasTags()
	{
		return $this->tags ? true : false;
	}

	public function tags()
	{
		return $this->belongsToMany('Nht\Hocs\Tags\Tag', 'posts_tags', 'post_id');
	}


	public function comments() {
		return $this->hasMany('Nht\Hocs\Posts\PostComment', 'post_id');
	}
}
