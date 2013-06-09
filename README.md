DiskCacheServiceProvider
=======================

A disk cache service for silex

Registering
-----------

In composer.json add this to your dependencies

	"cjmarkham/disk-cache": "dev-master"

Then to register

	$app->register(new DiskCache\DiskCacheServiceProvider());

Options
-------

* ```cache_dir``` - The path to the output directory

Usage
-----

	$app->register(new DiskCache\DiskCacheServiceProvider(), array(
	    'diskcache.cache_dir' => dirname(dirname(__FILE__)) . '/cache'
	));

	$app['diskcache']->set('foo', 'bar');
	$app['diskcache']->get('foo');
	$app['diskcache']->delete('foo');

Groups
------

Groups can be defined using a period (.).

	$app['diskcache']->set('groupname.foo');
	$app['diskcache']->delete_group('groupname');