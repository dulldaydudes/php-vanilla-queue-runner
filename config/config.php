<?php

declare(strict_types = 1);

use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;

$aggregator = new ConfigAggregator(
    [
        \MiniCliRoutes\ConfigProvider::class,
        \JobQueueHandler\ConfigProvider::class,
        \EventSystem\ConfigProvider::class,
        \App\ConfigProvider::class,
        new PhpFileProvider(realpath(__DIR__) . '/autoload/{{,*.}global,{,*.}local}.php'),
    ],
);

return $aggregator->getMergedConfig();
