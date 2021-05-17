<?php

declare(strict_types=1);

namespace EventSystem;

/**
 * Class ConfigProvider
 * @package EventSystem
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
            ],
        ];
    }
}
