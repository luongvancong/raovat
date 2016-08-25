<?php namespace Nht\Hocs\Ips;

interface IpRepository {

	public function getAllIpsByLocation($location = 'VN');

	public function isRemoteIpInLocation($location, $ip2Long = null);
}