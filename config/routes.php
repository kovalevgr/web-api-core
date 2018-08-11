<?php

namespace {

    use App\Controller\PingAction\PingAction;

    /** @var Zend\Expressive\Application $app */
    $app->get('/', [PingAction::class], 'app.ping');

    exit(var_dump($app));

}