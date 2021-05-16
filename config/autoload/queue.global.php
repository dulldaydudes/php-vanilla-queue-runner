<?php

declare(strict_types=1);

return [
    'worker-config' => [
        'pid-file' => dirname(__DIR__, 2) . '/data/runner/lock.pid',
        'time-slice-in-seconds' => 5,
        'serialize-path' => dirname(__DIR__, 2). 'data/serialize/jobs/'
    ],
];
