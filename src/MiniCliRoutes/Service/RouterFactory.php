<?php

declare(strict_types=1);

namespace MiniCliRoutes\Service;

use Psr\Container\ContainerInterface;

/**
 * Class RouterFactory
 * @package MiniCliRoutes\Service
 */
class RouterFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     *
     * @return \MiniCliRoutes\Service\Router
     */
    public function __invoke(ContainerInterface $container): Router
    {
        return new Router();
    }
}
