<?php namespace Nht\Hocs\PostStatistics;

use Nht\Hocs\Posts\Post;
use Nht\Hocs\Core\BaseRepository;

class DbPostStatisticRepository extends BaseRepository implements PostStatisticRepository {

	public function __construct(PostStatistic $model) {
		$this->model = $model;
	}


	public function getStatisticsByPostId($postId) {
		return $this->model->where('post_id', $postId)->first();
	}


	public function incrementViews(Post $post) {
		if($statistic = $this->getStatisticsByPostId($post->id)) {
			$statistic->views ++;
			return $this->model->where('post_id', $post->id)->update(['views' => $statistic->views]);
		}

		$views = $post->views + 1;

		return $this->model->insert(['post_id' => $post->id, 'views' => $views]);
	}


	public function getAll() {
		return $this->model->all();
	}

}
