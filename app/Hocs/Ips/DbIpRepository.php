<?php namespace Nht\Hocs\Ips;

use Illuminate\Database\DatabaseManager as DB;
use Nht\Hocs\Core\BaseRepository;

class DbIpRepository extends BaseRepository implements IpRepository {

	public function __construct(Ip $model, DB $db) {
		$this->model = $model;
		$this->db = $db;
	}


	public function getAllIpsByLocation($location = 'VN') {
		return $this->model->where('type', $location)->get();
	}


	public function isRemoteIpInLocation($location, $ip2Long = null) {
		$ips = $this->getAllIpsByLocation($location);

		if(!$ip2Long) $ip2Long = @ip2long($_SERVER['REMOTE_ADDR']);

		foreach($ips as $ip) {
			if($ip2Long >= $ip->start && $ip2Long <= $ip->end) {
				return true;
			}
		}

		return false;
	}
}