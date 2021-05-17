<?php

declare(strict_types=1);

namespace JobQueueHandler\Job;

interface EventInterface
{
    // Worker event constants
    const WORKER_INSTANCE       = 100;
    const WORKER_STARTUP        = 101;
    const WORKER_SHUTDOWN       = 102;
    const WORKER_FORCE_SHUTDOWN = 103;
    const WORKER_REGISTER       = 104;
    const WORKER_UNREGISTER     = 105;
    const WORKER_WORK           = 106;
    const WORKER_FORK           = 107;
    const WORKER_FORK_ERROR     = 108;
    const WORKER_FORK_PARENT    = 109;
    const WORKER_FORK_CHILD     = 110;
    const WORKER_WORKING_ON     = 111;
    const WORKER_DONE_WORKING   = 112;
    const WORKER_KILLCHILD      = 113;
    const WORKER_PAUSE          = 114;
    const WORKER_RESUME         = 115;
    const WORKER_WAKEUP         = 116;
    const WORKER_CLEANUP        = 117;
    const WORKER_LOW_MEMORY     = 118;
    const WORKER_CORRUPT        = 119;

    // Job event constants
    const JOB_INSTANCE       = 200;
    const JOB_QUEUE          = 201;
    const JOB_QUEUED         = 202;
    const JOB_DELAY          = 203;
    const JOB_DELAYED        = 204;
    const JOB_QUEUE_DELAYED  = 205;
    const JOB_QUEUED_DELAYED = 206;
    const JOB_PERFORM        = 207;
    const JOB_RUNNING        = 208;
    const JOB_COMPLETE       = 209;
    const JOB_CANCELLED      = 210;
    const JOB_FAILURE        = 211;
    const JOB_DONE           = 212;
}
