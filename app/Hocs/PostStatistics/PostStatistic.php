<?php namespace Nht\Hocs\PostStatistics;

use Illuminate\Database\Eloquent\Model;

class PostStatistic extends Model {

	protected $table = 'post_statistics';
	public $timestamps = false;

	protected $rules = [
		"post_id" => "required",
		"views"   => "required"
	];
}