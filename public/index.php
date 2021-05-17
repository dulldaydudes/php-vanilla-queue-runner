<?php

declare(strict_types=1);

// Delegate static file requests back to the PHP built-in webserver
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

/**
 * Self-called anonymous function that creates its own scope and keeps the global namespace clean.
 */
(function () {
    /** @var \Psr\Container\ContainerInterface $container */
    $container = require 'config/container.php';
    $config = $container->get('config') ?: [];
    $router = $container->get('router');
    (require 'config/routes.php')($router, $container);

    /** @var \JobQueueHandler\Service\Runner $queueHandler */
    $queueHandler = $container->get(\JobQueueHandler\Service\Runner::class);
    $queueHandler->run($config, $router, $container);
})();
