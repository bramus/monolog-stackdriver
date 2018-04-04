<?php

namespace CodeInternetApplications\MonologStackdriver\Laravel;

use Monolog\Logger;
use CodeInternetApplications\MonologStackdriver\StackdriverHandler;

class CreateStackdriverLogger
{
    /**
     * Create a custom Monolog instance.
     *
     * @param  array  $config
     * @return Logger
     */
    public function __invoke(array $config)
    {
        $projectId            = $config['logName']              ?? '';
        $loggingClientOptions = $config['loggingClientOptions'] ?? [];
        $entryOptionsWrapper  = $config['entryOptionsWrapper']  ?? 'stackdriver';
        $level                = $config['level']                ?? Logger::DEBUG;
        $bubble               = $config['bubble']               ?? true;

        $stackdriverHandler = new StackdriverHandler($projectId, $loggingClientOptions, $entryOptionsWrapper, $level, $bubble);

        $logger = new Logger('stackdriver', [$stackdriverHandler]);

        return $logger;
    }
}
