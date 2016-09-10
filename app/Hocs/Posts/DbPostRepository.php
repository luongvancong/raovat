<?php

namespace Nht\Hocs\Posts;

use Nht\Hocs\Posts\Post;
use Nht\Hocs\Core\BaseRepository;

use Nht\Hocs\Elasticsearchs\Post as EsPost;
use Nht\Hocs\Products\Product;

use Nht\Hocs\Ips\IpRepository;
use Nht\Hocs\PostStatistics\PostStatisticRepository;

use Illuminate\Database\DatabaseManager as DB;

/**
 * Class DbUserRepository.
 *
 * @author	AlvinTran
 */
class DbPostRepository extends BaseRepository implements PostRepository
{
	protected $model;

	public function __construct(Post $model, DB $db, IpRepository $ip, PostStatisticRepository $postStatistic)
	{
		$this->model         = $model;
		$this->ip            = $ip;
		$this->db            = $db;
		$this->postStatistic = $postStatistic;
	}

	public function getByProductId($pid, $limit = 5)
	{
		return $this->model->where('product_id', $pid)->paginate($limit);
	}


	public function getPosts($perPage = 20, $filterArray = array()) {
		$q     = array_get($filterArray, 'q');
		$title = array_get($filterArray, 'title');
		$status = array_get($filterArray, 'status');

		$query = $this->model->orderBy('updated_at', 'DESC');

		if($q) {
			$query->where('title', 'LIKE', '%'. $q .'%');
		}

		if($title) {
			$query->where('title', 'LIKE', '%'. $title .'%');
		}

		if(!is_null($status)) {
			$query->where('active', $status);
		}

		return $query->paginate($perPage);
	}


	public function getMostViewPostsPaginated($perPage = 5) {
		return $this->model->orderBy('views', 'DESC')->paginate($perPage);
	}

	public function getMostViewPosts($take = 5) {
		return $this->model->orderBy('views', 'DESC')->take($take)->get();
	}


	public function getNewestPosts($take = 5) {
		return $this->model->orderBy('updated_at', 'DESC')->take($take)->get();
	}



	public function getPostsByPage($perPage = 100, $page = 1) {
		$totalPosts = $this->count();
		$part = ceil($totalPosts / $perPage);
		if($part == 0) $part = 1;

		$start = ($page - 1) * $perPage;

		return $this->model->where('active', 1)->orderBy('updated_at', 'DESC')->skip($start)->take($perPage)->get();
	}


	public function getPostsInCategoryStr($categoryname, $take = 10) {
		return $this->model->where('category', $categoryname)->orderBy('updated_at', 'DESC')->take($take)->get();
	}


	public function incrementViews(Post $post) {

		// Nếu views <= 301 và là Ip VN thì cộng thẳng vào bảng posts
		// ngược lại thì lưu vào bảng post_statistics
		$isIpVn = $this->ip->isRemoteIpInLocation('VN');

		$limit = isLocalhost() ? 3 : 301;
		$limitViewPerIpPerDay = 5;
		$clientIp = @ip2long($_SERVER['REMOTE_ADDR']);

		if(!isLocalhost()) {
			if(!$isIpVn) return ;
		}

		// Giới hạn 1 ip được xem 1 ngày được bao lần
		if( $this->countIpViewPost($clientIp, $post) <= $limitViewPerIpPerDay ) {
			// Add ip view this post for check
			$this->addIpViewPost($post);

			// Cộng view
			if($post->views <= $limit) {
				$post->views ++;
				return $this->db->table('posts')->where('id', $post->id)->update(['views' => $post->views]);
			}

			return $this->postStatistic->incrementViews($post);
		}
	}


	public function addIpViewPost(Post $post) {
		return $this->db->table('post_ips')->insert([
			'post_id'   => $post->id,
			'ip'        => @ip2long($_SERVER['REMOTE_ADDR']),
			'last_time' => time()
		]);
	}


	public function countIpViewPost($ip2long, Post $post) {
		return $this->db->table('post_ips')
		                ->where('ip', $ip2long)
		                ->where('post_id', $post->id)
		                ->count();
	}


	public function countPostByDateRange($startDate, $endDate) {
		return $this->model->whereBetween('created_at', [$startDate, $endDate])->count();
	}

	public function getIdCurrent($data){
		return $this->model->insertGetId($data);
	}

	public function getCityCatePost($city_id, $category_child_all_id = '', $perPage = 2, $filterArray = array()) {
		$name = array_get($filterArray, 'name');
		$query = $this->model->where('city_id', $city_id);

		if ($category_child_all_id) {
			$query->whereIn('category_id', $category_child_all_id);
		}
		if($name) {
			$query->where('name', 'LIKE', '%'. $name .'%');
		}

		$query->orderBy('updated_at', 'DESC');

		return $query->paginate($perPage);
	}

	public function getCityPostCateChild($city_id, $category_id = '', $perPage = 2, $filterArray = array()) {
		$name = array_get($filterArray, 'name');
		$query = $this->model->where('city_id', $city_id);

		if ($category_id) {
			$query->where('category_id', $category_id);
		}
		if($name) {
			$query->where('name', 'LIKE', '%'. $name .'%');
		}

		$query->orderBy('updated_at', 'DESC');

		return $query->paginate($perPage);
	}

	public function getCityDistrictPost($city_id = '', $district_id = '', $perPage = 2, $filterArray = array()) {
		$name = array_get($filterArray, 'name');
		$query = $this->model->join('cities', 'posts.city_id', '=', 'cities.cit_id')->where('city_id', $city_id);

		if ($district_id) {
			$query->where('district_id', $district_id);
		}
		if($name) {
			$query->where('name', 'LIKE', '%'. $name .'%');
		}

		$query->orderBy('updated_at', 'DESC');

		return $query->paginate($perPage);
	}

	public function getPostSame($city_id, $category_id, $perPage = 2, $filterArray = array()) {
		$name = array_get($filterArray, 'name');
		$query = $this->model->where('city_id', $city_id)->where('category_id', $category_id);

		if($name) {
			$query->where('name', 'LIKE', '%'. $name .'%');
		}

		$query->orderBy('updated_at', 'DESC');

		return $query->paginate($perPage);
	}

	public function getAll(){
		return $this->model->orderBy('title', 'ASC')->get();
	}

	public function getSearchPosts($tukhoa = '', $category_id = '', $city_id = '', $perPage = 2, $filterArray = array()){
		$name = array_get($filterArray, 'name');
		$query = $this->model->where('title', 'LIKE', '%'. $tukhoa .'%');

		if ($category_id) {
			$query->where('category_id', $category_id);
		}

		if ($city_id) {
			$query->where('city_id', $city_id);
		}
		if($name) {
			$query->where('name', 'LIKE', '%'. $name .'%');
		}

		$query->orderBy('updated_at', 'DESC');

		return $query->paginate($perPage);
	}

	public function getTinCategories($category_child_all_id, $perPage = 2, $filterArray = array()){
		$query = $this->model->whereIn('category_id', $category_child_all_id);

		$query->orderBy('updated_at', 'DESC');

		return $query->paginate($perPage);
	}

}