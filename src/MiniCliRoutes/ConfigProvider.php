<?php

declare(strict_types=1);

namespace MiniCliRoutes;

use MiniCliRoutes\Service\RouterFactory;

/**
 * Class ConfigProvider
 * @package MiniCliRoutes
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
                'router' => RouterFactory::class,
            ],
        ];
    }
}
