<?php

declare(strict_types=1);

use MiniCliRoutes\Service\Router;
use Psr\Container\ContainerInterface;

return static function (Router $router, ContainerInterface $container): void {
    $router->add(
        'start',
        [
            \App\Handler\RunnerHandler::class,
        ],
        'start'
    );

    $router->add(
        'add job',
        [
            \App\Handler\JobHandler::class,
        ],
        'addJob',
    );

    $router->add(
        'add queue',
        [
            \App\Handler\QueueHandler::class,
        ],
        'addQueue',
    );
};
