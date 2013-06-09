<?php

namespace DiskCache;

use Silex\Application;
use Silex\ServiceProviderInterface;

class DiskCacheServiceProvider implements ServiceProviderInterface
{
	public function register(Application $app)
	{
		$app['diskcache'] = $app->share(function() use ($app) {
			$cache = new DiskCache();

			if (isset($app['diskcache.cache_dir']))
			{
				$cache->output_dir = $app['diskcache.cache_dir'];
			}

			$cache->initialize();

			return $cache;
		});
	}

	public function boot(Application $app) {}
}