<?php

declare(strict_types=1);

namespace JobQueueHandler\Job;

interface JobInterface
{
    // Job status constants
    const STATUS_WAITING   = 1;
    const STATUS_DELAYED   = 2;
    const STATUS_RUNNING   = 3;
    const STATUS_COMPLETE  = 4;
    const STATUS_CANCELLED = 5;
    const STATUS_FAILED    = 6;
}
