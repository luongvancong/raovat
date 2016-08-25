<?php
namespace Nht\Hocs\Advertise;

use Nht\Hocs\Advertise\AdsRepository;
use Nht\Hocs\Core\BaseRepository;

use Xss, DB;

class DbAdsRepository extends BaseRepository implements AdsRepository
{
	
	public function __construct(Ads $ads, AdsRegister $register, 
		AdsClick $click, AdsStatistic $statistic)
	{
		$this->ads = $ads;
		$this->register = $register;
		$this->click = $click;
		$this->statistic = $statistic;
	}

	public function getPaginate($perPage = 20, array $filter_array = [])
	{
		$user_id = array_get($filter_array, 'user_id');
		$name = Xss::clean(array_get($filter_array, 'name'));
		$id	= (int) array_get($filter_array, 'id');

		$query = $this->ads->with('users');
		$query->select('ads.*', 'users.name', 'users.email')
			->join('users', 'users.id', '=', "ads.user_id")
			->orderBy('id', 'desc');

		if ($name) 
			$query->where('users.name', 'LIKE', '%'. $name .'%');
		if ($id)
			$query->where('ads.id', $id);
		if($user_id)
			$query->where('ads.user_id', $user_id);

		return $query->paginate($perPage);
	}

	public function saveAds($data)
	{
		$data['updated_at'] = date('Y-m-d H:i:s');
		return $this->ads->insert($data);
	}

	public function updateActive($id)
	{
		$ads = $this->ads->find($id);
		$ads->active = abs($ads->getActive() - 1);
		$ads->update();

		return $ads;
	}

	public function getAdsById($id)
	{
		return $this->ads->find($id);
	}

	public function updateAds($data, $id)
	{
		$ads = $this->ads->find($id);
		foreach ($data as $key => $value) {
			$ads->$key = $value;
		}

		return $ads->update();
	}

	public function saveRegister($data)
	{
		$data['updated_at'] = date('Y-m-d H:i:s');
		return $this->register->insert($data);
	}

	public function getRegisterPaginate($perPage = 20, array $filter_array = [])
	{
		$name = Xss::clean(array_get($filter_array, 'name'));
		$id = (int) array_get($filter_array, 'id');

		$query = $this->register->orderBy('id', 'desc');

		if ($name) 
			$query->where('name', 'LIKE', '%'. $name .'%');
		if ($id)
			$query->where('id', $id);

		return $query->paginate($perPage);
	}

	public function deleteRegister($id)
	{
		$register = $this->register->find($id);
		return $register->delete();
	}

	public function deleteAds($id)
	{
		$ads = $this->ads->find($id);
		return $ads->delete();
	}

	public function countAdsClickIp($data)
	{
		return $this->click->where('ip', '=' , $data['ip'])
			->where('ads_id', '=', $data['ads_id'])
			->get()->count();
	}

	public function saveAdsClick($data)
	{
		if ($this->countAdsClickIp($data) < 1) {
			$data['created_at'] = date('Y-m-d H:i:s');
			$data['updated_at'] = date('Y-m-d H:i:s');
			return $this->click->insert($data);
		}
	}

	public function insertStatisticWithAdsId($id)
	{
		$this->statistic->where('ads_id', '=', $id)->delete();

		$data = DB::select('select count(*) as count, id,
			DAY(`created_at`) as day,
			MONTH(`created_at`) as month,
			YEAR(`created_at`) as year
			from `ads_clicks`
			where `ads_id` = '. $id .'
			group by DATE(`created_at`), MONTH(`created_at`), YEAR(`created_at`)
		');

		$insert = [];
		foreach ($data as $key => $value) {
			$insert[] = [
				'ads_id' => $id,
				'count'  => $value->count,
				'day'	 => date('Y-m-d', strtotime($value->year. '-' .$value->month. '-' .$value->day)), 
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			];
		}
	    
		return $this->statistic->insert($insert);
	}

	public function getStatisticByAdsId($id, $from, $to)
	{
		// dd($from,$to);
		$from = $this->change_date($from);
		$to   = $this->change_date($to);
		return $this->statistic->where('ads_id', '=', $id)
			->where('day', '>', $from)
			->where('day', '<=', $to)
			->get();
	}

	function change_date($date) {
		$date = $date . date("H:i:s");
        $date = str_replace('/', '-', $date);
        $date = date('Y-m-d', strtotime($date));
        return $date;
	}

	public function getAllActiveAds($arr_ads)
	{

		$count_ads = DB::select('
			select `position`, COUNT(`id`) as `count` 
			from `ads` 
			where `active` = 1 and 
				NOW() between `created_at` and `expired` 
			group by `position`');
		
		// Delete
		foreach ($count_ads as $value) {
			$count = $value->count;
			$position = $value->position;
			if ($count <= 1) {
				if ( isset($arr_ads[$position]) )
					unset($arr_ads[$position]);
			}
		}

		if ($arr_ads != null)
			$str_ads = 'and `id` not in ('. implode(',', $arr_ads) .')';
		else
			$str_ads = '';

		return DB::select('
			select * from (
				select * from `ads` 
				where `active` = 1
				and NOW() between `created_at` and `expired`
				'. $str_ads  .'
				order by RAND()
			) as `tb` 
			group by `position`	
		');
	}

	public function getClickOrderByAdsIds()
	{
		return DB::select('select count(*) as `count`, `ads_id`
			from `ads_clicks`
			where (`created_at` 
				between "'. date('Y-m-d 00:00:00', strtotime('-1 days')) .'"
				and "'. date('Y-m-d 23:59:59', strtotime('-1 days')) .'"
			)
			group by `ads_id` 
		');
	}

	public function updateStatisticByClick(){
		$arr_data = $this->getClickOrderByAdsIds();
        
        $insert = [];
        foreach ($arr_data as $value) {
            $insert[] = [
                'ads_id' => $value->ads_id,
                'count'  => $value->count,
                'day'    => date('Y-m-d', strtotime('-1 days')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        $result = $this->statistic->insert($insert);
        // dd($result);
        return $result;
	}

}