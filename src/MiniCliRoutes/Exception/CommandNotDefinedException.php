<?php

declare(strict_types=1);

namespace MiniCliRoutes\Exception;

/**
 * Class CommandNotDefinedException
 * @package MiniCliRoutes\Exception
 */
class CommandNotDefinedException extends \Exception
{
    public const ERROR_MSG = '%s command is unknown';

    /**
     * @param $command
     *
     * @return static
     */
    public static function unknownCommand($command): self
    {
        return new static(
            sprintf(
                static::ERROR_MSG,
                $command
            )
        );
    }
}
