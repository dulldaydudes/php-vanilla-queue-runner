<?php

declare(strict_types=1);

namespace JobQueueHandler\Service;

/**
 * Class JobQueueHandlerRunner
 * @package JobQueueHandler
 */
class Runner
{
    protected int $timeSlice = 5;
    protected array $workers = [];

    /**
     *
     */
    public function run(): void
    {
        echo 'Starting choreographer for 25 cycles' . PHP_EOL;
        $loopCount = 0;
        $jobs = 0;
        $round = 0;
        while ($round < 25) {
            $loopCount++;
            echo "#############################################################\n";
            echo 'Round: '. date('h:i:s') ." $loopCount \n";
            if (count($this->workers) < 5) {
                $this->workers[$jobs] = new Worker();
                $jobs++;
            }
            foreach ($this->workers as $index => $worker) {
                echo 'Job: '. ($index + 1) . PHP_EOL;

                /*
                command	string	The command string that was passed to proc_open().
                pid	int	process id
                running	bool	true if the process is still running, false if it has terminated.
                signaled	bool	true if the child process has been terminated by an uncaught signal. Always set to false on Windows.
                stopped	bool	true if the child process has been stopped by a signal. Always set to false on Windows.
                exitcode	int	The exit code returned by the process (which is only meaningful if running is false). Only first call of this function return real value, next calls return -1.
                termsig	int	The number of the signal that caused the child process to terminate its execution (only meaningful if signaled is true).
                stopsig	int	The number of the signal that caused the child process to stop its execution (only meaningful if stopped is true).
                */

                if ($worker->getState()['running'] == true) {
                    echo 'Job running' . PHP_EOL;
                } else {
                    echo 'Job ended' . PHP_EOL;
                    echo 'Out :'. $worker->getOut() . PHP_EOL;
                    echo 'Error :'. $worker->getError() . PHP_EOL . PHP_EOL;
                    unset($worker);
                    unset($this->workers[$index]);
                }
            }
            sleep($this->timeSlice);
            $round++;
        }

        echo 'going to sleep…' . PHP_EOL;
    }

    public function __destruct()
    {
        foreach ($this->workers as $index => $worker) {
            unset($worker);
            unset($this->workers[$index]);
        }
    }
}
