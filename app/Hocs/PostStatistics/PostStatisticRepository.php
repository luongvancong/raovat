<?php namespace Nht\Hocs\PostStatistics;

use Nht\Hocs\Posts\Post;

interface PostStatisticRepository {

	public function getStatisticsByPostId($postId);

	public function incrementViews(Post $post);

	public function getAll();
}