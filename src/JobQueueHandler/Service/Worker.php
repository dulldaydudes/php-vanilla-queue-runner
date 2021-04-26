<?php

declare(strict_types=1);

namespace JobQueueHandler\Service;

class Worker
{
    private const STDIN = 0;
    private const STDOUT = 1;
    private const STDERR = 2;

    private const NON_BLOCKING = false;
    private const BLOCKING = true;

    private $process = null;
    private array $pipes = [];

    public function __construct()
    {
        echo "Create new Worker \n";
        $descriptorSpec = [
            self::STDIN => ["pipe", "r"],  // STDIN ist eine Pipe, von der das Child liest
            self::STDOUT => ["pipe", "w"],  // STDOUT ist eine Pipe, in die das Child schreibt
            self::STDERR => ["pipe", "w"]   // STDERR ist eine Pipe,
            // in die geschrieben wird
        ];

        $cwd = '/public';
        $env = ['some_option' => 'aeiou'];

        $this->process = proc_open(
            "php ./public/job.php",
            $descriptorSpec,
            $this->pipes,
            $cwd,
            $env
        );

        if (false === is_resource($this->process)) {
            throw new \RuntimeException();
        }

        stream_set_blocking(
            $this->pipes[self::STDOUT],
            self::NON_BLOCKING
        );
    }

    public function getState():array
    {
        return proc_get_status($this->process);
    }

    public function getIn(): string
    {
        return stream_get_contents($this->pipes[self::STDIN]);
    }

    public function getOut(): string
    {
        return stream_get_contents($this->pipes[self::STDOUT]);
    }

    public function getError(): string
    {
        return stream_get_contents($this->pipes[self::STDERR]);
    }

    public function __destruct()
    {
        fclose($this->pipes[self::STDIN]);
        fclose($this->pipes[self::STDOUT]);
        fclose($this->pipes[self::STDERR]);
        proc_close($this->process);
    }
}
