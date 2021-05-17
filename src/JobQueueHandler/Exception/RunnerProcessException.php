<?php

declare(strict_types=1);

namespace JobQueueHandler\Exception;

/**
 * Class RunnerProcessException
 * @package JobQueueHandler\Exception
 */
class RunnerProcessException extends \Exception
{
    /**
     *
     */
    public const ERROR_MSG = 'Unexpected error opening or locking lock file `%s`. Perhaps you ' .
    'don\'t  have permission to write to the lock file or its ' .
    'containing directory?';

    /**
     * @param string $path
     *
     * @return static
     */
    public static function cantCreatePidFile(string $path): self
    {
        return new static(
            sprintf(
                static::ERROR_MSG,
                $path
            )
        );
    }
}
