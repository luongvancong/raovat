<?php

namespace Nht\Hocs\Posts;

use Nht\Hocs\Posts\Post;
use Nht\Hocs\Posts\PostRepository;
use Illuminate\Support\Collection;
use Nht\Hocs\Core\MongoDb;

/**
 * Class DbUserRepository.
 *
 * @author	AlvinTran
 */
class MongoPostRepository implements PostRepository
{
    protected $eModel;
    protected $mModel;

	public function __construct(Post $eModel)
	{
        // Post Eloquent
        $this->eModel = $eModel;

        // Configuration
        $dbhost = 'localhost';
        $dbname = 'sat8';
        $collection = 'blog';

        // Connect to test database
        $m = new \MongoClient("mongodb://$dbhost");
        $db = $m->$dbname;
        $this->mModel = $db->$collection;
	}

	public function getAll()
    {
		return $this->mModel->find();
	}

	public function getById($id) {
		// return $this->innerRepository->getById($id);
	}

	public function search($query = "") {
		// $items = $this->searchOnElasticsearch($query);
  //       return $this->buildCollection($items);
	}
}