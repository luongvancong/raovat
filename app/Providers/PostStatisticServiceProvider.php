<?php namespace Nht\Providers;

use Illuminate\Support\ServiceProvider;

class PostStatisticServiceProvider extends ServiceProvider {
	public function register() {
		$this->app->singleton("Nht\Hocs\PostStatistics\PostStatisticRepository", "Nht\Hocs\PostStatistics\DbPostStatisticRepository");
	}
}