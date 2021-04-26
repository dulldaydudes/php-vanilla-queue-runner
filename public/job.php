<?php

declare(strict_types=1);

echo "I'm a job\n";
$timeToWait = rand(3, 20);
echo "I worked for $timeToWait seconds\n";
sleep($timeToWait);
echo "And now I'm done";
