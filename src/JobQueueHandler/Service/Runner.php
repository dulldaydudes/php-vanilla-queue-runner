<?php

declare(strict_types=1);

namespace JobQueueHandler\Service;

use JobQueueHandler\Exception\RunnerProcessException;
use JobQueueHandler\Job\FileLoader;
use JobQueueHandler\Job\LoaderInterface;
use JobQueueHandler\Queue\JobQueue;
use MiniCliRoutes\Service\Router;
use Psr\Container\ContainerInterface;

/**
 * Class JobQueueHandlerRunner
 * @package JobQueueHandler
 */
class Runner
{
    /** @var int */
    protected int $timeSlice = 5;
    /** @var JobQueue */
    protected JobQueue $queue;
    /** @var array  */
    protected array $workers = [];
    /** @var array */
    protected array $config;
    /** @var bool */
    protected bool $killMe = false;
    /** @var resource */
    protected $lockFile;
    /** @var resource */
    protected $gotLock;
    /** @var resource */
    protected $wouldBlock;
    /** @var \JobQueueHandler\Job\LoaderInterface */
    protected LoaderInterface $jobLoader;
    /** @var \MiniCliRoutes\Service\Router  */
    protected Router $router;

    /**
     * @param array $config
     * @param \MiniCliRoutes\Service\Router $router
     * @param ContainerInterface $container
     */
    public function run(array $config, Router $router, ContainerInterface $container): void
    {

        try {
            $middleWareList = $router->handle();
        } catch (\Exception $exception) {
            exit ($exception->getMessage());
        }

        foreach ($middleWareList as $middleware) {
            $container->get($middleware)();
        }



//        $this->config = $config['worker-config'];
//        try {
//            $this->lockProzess();
//        } catch (RunnerProcessException $exception) {
//            exit ($exception->getMessage());
//        }
//        $this->timeSlice = $this->config['time-slice-in-seconds'] ?: 5;
//        $this->queue = new JobQueue();
//
//        // ToDo: DB Loader?
//        $this->jobLoader = new FileLoader($this->config['serialize-path']);
//        do {
//            // Job-Loader
//            $this->jobLoader->checkForNew($this->queue);
//            // Job-Processor
//            foreach ($this->queue as $job) {
//                $this->workers[] = new Worker($job);
//            }
//            sleep($this->timeSlice);
//        } while (!$this->$this->killMe);
//
//        $this->unloadAll();
    }

    /**
     * @throws \JobQueueHandler\Exception\RunnerProcessException
     */
    protected function lockProzess(): void
    {
        $this->lockFile = fopen($this->config['worker-config']['pid-file'], 'c');
        $this->gotLock = flock($this->lockFile, LOCK_EX | LOCK_NB, $this->wouldBlock);
        if ($this->lockFile === false || (!$this->gotLock && !$this->wouldBlock)) {
            throw RunnerProcessException::cantCreatePidFile($this->config['worker-config']['pid-file']);
        } else if (!$this->gotLock && $this->wouldBlock) {
            exit('Another instance is already running; terminating.');
        }

        // Lock acquired; let's write our PID to the lock file for the convenience
        // of humans who may wish to terminate the script.
        ftruncate($this->lockFile, 0);
        fwrite($this->lockFile, getmypid() . PHP_EOL);
    }

    protected function unlockProzess(): void
    {
        // All done; we blank the PID file and explicitly release the lock
        // (although this should be unnecessary) before terminating.
        ftruncate($this->lockFile, 0);
        flock($this->lockFile, LOCK_UN);
    }

    protected function unloadAll()
    {
        foreach ($this->workers as $index => $worker) {
            unset($worker);
            unset($this->workers[$index]);
        }

        $this->unlockProzess();
    }

    public function __destruct()
    {
//        $this->unloadAll();
    }
}
