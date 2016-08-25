<?php

namespace Nht\Hocs\Cities;

interface CityRepository
{
    public function getDistrictsByCityId($cityId);
}