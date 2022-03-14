<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Queue;

class Manager
{
    /**
     * @var Models\Job
     */
    protected $job = NULL;
    /**
     * @var Log
     */
    protected $log = NULL;
    public function __construct(Models\Job $job)
    {
        $this->job = $job;
        $this->log = new Services\Log($this->job);
    }
    public function fire()
    {
        try {
            $this->job->setRunning();
            $ret = $this->resolveAndFire($this->job->job, $this->job->data);
            if ($ret !== false) {
                $this->job->setFinished();
            }
        } catch (\Exception $ex) {
            $this->job->setError();
            $this->job->setRetryAfter(date("Y-m-d H:i:s", strtotime("+ 60 seconds")));
            $this->job->increaseRetryCount();
            $this->log->error($ex->getMessage(), debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        }
    }
    protected function resolveAndFire($job, $data)
    {
        list($class, $method) = $this->parseJob($job);
        $instance = $this->resolve($class);
        if (method_exists($instance, "setJobModel")) {
            $instance->setJobModel($this->job);
        }
        return call_user_func_array([$instance, $method], unserialize($data));
    }
    protected function resolve($class)
    {
        return \ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection\DependencyInjection::create($class);
    }
    protected function parseJob($job)
    {
        $segments = explode("@", $job);
        return 1 < count($segments) ? $segments : [$segments[0], "fire"];
    }
}

?>