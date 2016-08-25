<?php namespace Nht\Providers;

use Illuminate\Support\ServiceProvider;

class IpServiceProvider extends ServiceProvider {

	public function register() {
		$this->app->singleton("Nht\Hocs\Ips\IpRepository", "Nht\Hocs\Ips\DbIpRepository");
	}
}