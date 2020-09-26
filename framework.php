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
	->in($dir = __DIR__ . '/project/framework/src');

$versions = GitVersionCollection::create($dir)
	->add('master', 'Laravel Framework');

return new Sami($iterator, [
	'title' => 'Laravel Framework Api',
	'versions' => $versions,
	'build_dir' => __DIR__.'/project/build/framework/%version%',
	'cache_dir' => __DIR__.'/project/cache/framework/%version%',
	'default_opened_level' => 2,
	'remote_repository' => new GitHubRemoteRepository('laravel/framework', dirname($dir)),
]);
