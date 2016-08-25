<?php

namespace Nht\Hocs\Advertise;

use Illuminate\Database\Eloquent\Model;

class AdsStatistic extends Model
{
    public $table = 'ads_statistic';
    
    public function getCount()
    {
    	return $this->count;
    }

    public function getDay()
    {
    	return $this->day;
    }

}
