<?php

namespace Nht\Hocs\Posts;

use Nht\Hocs\Products\Product;
use Nht\Hocs\Tags\Tag;

/**
 * Interface description.
 *
 * @author	AlvinTran
 */
interface PostRepository
{
	public function getAll();
	public function getById($id);

	public function getPosts($perPage = 20, $filterArray = array());


    /**
     * Tin cùng danh mục dạng text
     * @param  str  $categoryname
     * @param  integer $take
     * @return Collection
     */
    public function getPostsInCategoryStr($categoryname, $take = 10);


    /**
     * Tăng view cho bài viết
     *
     * @param  integer $postId
     * @return void
     */
    public function incrementViews(Post $post);


    /**
     * Add ip view this post
     *
     * @param Post $post
     */
    public function addIpViewPost(Post $post);


    public function countIpViewPost($ip2long, Post $post);

    /**
     * Tin tức xem nhiều nhất
     * @param  integer $take
     * @return Collection
     */
    public function getMostViewPosts($take = 5);


    /**
     * Count post by date range
     * @param  str $startDate
     * @param  str $endDate
     * @return int
     */
    public function countPostByDateRange($startDate, $endDate);

    public function getIdCurrent($data);
}