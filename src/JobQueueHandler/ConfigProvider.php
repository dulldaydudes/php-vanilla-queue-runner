<?php

declare(strict_types=1);

namespace JobQueueHandler;

use JobQueueHandler\Service\Runner;
use JobQueueHandler\Service\RunnerFactory;

/**
 * Class ConfigProvider
 * @package JobQueueHandler
 */
class ConfigProvider
{
    /**
     * @return \string[][][]
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    /**
     * @return \string[][]
     */
    public function getDependencies(): array
    {
        return [
            'factories' => [
                Runner::class => RunnerFactory::class,
            ],
        ];
    }
}
