<?php

use App\Utils\ModuleConfigProvider;
use Zend\ConfigAggregator\ArrayProvider;
use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ConfigAggregator\PhpFileProvider;
use App as Application;


//$cacheConfig = [
//    'config_cache_path' => 'data/config-cache.php',
//];

//$modules = require __DIR__ . '/modules.php';

$modules[] = new ModuleConfigProvider(Application\Module::class);
//$modules[] = new ArrayProvider($cacheConfig);
$modules[] = new PhpFileProvider('config/application.php');
$modules[] = new PhpFileProvider('config/package-loader.php');
//$modules[] = new PhpFileProvider(sprintf('config/environment/{%s}/*.php', implode(',', ApplicationMeta::applicationEnv()->getParentsWithSelf(true))));

$aggregator = new ConfigAggregator($modules, null);

return $aggregator->getMergedConfig();
