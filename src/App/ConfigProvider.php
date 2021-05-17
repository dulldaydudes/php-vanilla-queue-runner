<?php

declare(strict_types=1);

namespace App;

use App\Handler\JobHandler;
use App\Handler\QueueHandler;
use App\Handler\RunnerHandler;
use Laminas\ServiceManager\Factory\InvokableFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    protected function getDependencies(): array
    {
        return [
            'factories' => [
                JobHandler::class => InvokableFactory::class,
                QueueHandler::class => InvokableFactory::class,
                RunnerHandler::class => InvokableFactory::class,
            ],
        ];
    }
}
