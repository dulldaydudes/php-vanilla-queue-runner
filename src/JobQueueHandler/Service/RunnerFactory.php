<?php

declare(strict_types=1);

namespace JobQueueHandler\Service;

use Psr\Container\ContainerInterface;

/**
 * Class JobQueueHandlerRunnerFactory
 * @package JobQueueHandler
 */
class RunnerFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     *
     * @return \JobQueueHandler\Service\Runner
     */
    public function __invoke(ContainerInterface $container): Runner
    {
        return new Runner();
    }
}
