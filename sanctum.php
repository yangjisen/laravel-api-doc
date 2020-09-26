<?php

require __DIR__ . '/vendor/autoload.php';

use Sami\Sami;
use Symfony\Component\Finder\Finder;
use Sami\Version\GitVersionCollection;
use Sami\RemoteRepository\GitHubRemoteRepository;

$iterator = Finder::create()
	->files()
	->name('*.php')
	->exclude('stubs')
	->in($dir = __DIR__ . '/project/sanctum/src');

$versions = GitVersionCollection::create($dir)
	->add('2.x', 'Laravel Sanctum');

return new Sami($iterator, [
	'title' => 'Laravel Sanctum API',
	'versions' => 'master',
	'build_dir' => __DIR__.'/project/build/sanctum/%version%',
	'cache_dir' => __DIR__.'/project/cache/sanctum/%version%',
	'default_opened_level' => 2,
	'remote_repository' => new GitHubRemoteRepository('laravel/sanctum', dirname($dir)),
]);
