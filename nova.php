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
	->in($dir = __DIR__ . '/project/nova/src');

$versions = GitVersionCollection::create($dir)
	->add('3.0', 'Laravel Nova 3.x');

return new Sami($iterator, [
	'title' => 'Laravel Nova API',
	'versions' => 'master',	// 脚本复制使用了master
	'build_dir' => __DIR__.'/project/build/nova/%version%',
	'cache_dir' => __DIR__.'/project/cache/nova/%version%',
	'default_opened_level' => 2,
	'remote_repository' => new GitHubRemoteRepository('laravel/nova', dirname($dir)),
]);
