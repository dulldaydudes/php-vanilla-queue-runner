<?php

declare(strict_types=1);

namespace JobQueueHandler\Job;

use JobQueueHandler\Queue\JobQueue;

interface LoaderInterface
{
    public function checkForNew(JobQueue $jobQueue);

    public static function createJob(JobInterface $jobToSave, string $path);
}
