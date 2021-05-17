<?php

declare(strict_types=1);

namespace JobQueueHandler\Job;

use JobQueueHandler\Queue\JobQueue;
use Ramsey\Uuid\Uuid;

class FileLoader implements LoaderInterface
{
    protected string $path;

    /**
     * FileLoader constructor.
     *
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function checkForNew(JobQueue $jobQueue): array
    {
        $newJobs = [];
        foreach ($this->getCleanFolder() as $fileName) {
            if (is_file($fileName)) {
//                $jobQueue->addJob(unserialize(file_get_contents($file)));
                $jobQueue->addJob($fileName);
            }
        }

        return $newJobs;
    }

    public static function createJob(JobInterface $jobToSave, string $path)
    {
        $fileName = Uuid::uuid4()->toString();
        file_put_contents(
            $path . '/' . $fileName,
            serialize($jobToSave)
        );
    }

    /**
     * @return string[]
     */
    protected function getCleanFolder(): array
    {
        return array_diff(
            scandir($this->path),
            ['..', '.']
        );
    }
}
