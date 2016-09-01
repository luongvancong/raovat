<?php

namespace Nht\Hocs\Cities;

interface CityRepository
{
    public function getAllCities($perPage = 25, $filterArray = array());
    public function getAll();
    public function getCities();
    public function getDistrictsByCityId($cityId);
}