<?php

use Zend\Mvc\Application;
use Zend\Stdlib\ArrayUtils;

chdir(dirname(__DIR__));

if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (__FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

include __DIR__ . '/../vendor/autoload.php';

call_user_func(function () {
    /** @var \Interop\Container\ContainerInterface $container */
    $container = require __DIR__ . "/../config/container.php";
    require __DIR__ .  '/../bootstrap.php';

    /** @var \Zend\Expressive\Application $app */
    $app = $container->get(\Zend\Expressive\Application::class);

    require __DIR__ .  '/../config/pipeline.php';
    require __DIR__ .  '/../config/routes.php';


    $app->run();
});
