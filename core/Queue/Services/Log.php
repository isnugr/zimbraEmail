<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Queue\Services;

class Log
{
    /**
     * @var Models\Job
     */
    protected $job = NULL;
    const SUCCESS = "success";
    const ERROR = "error";
    const INFO = "info";
    public function __construct(\ModulesGarden\Servers\ZimbraEmail\Core\Queue\Models\Job $job)
    {
        $this->job = $job;
    }
    public function success($message, $additional = NULL)
    {
        $this->log(SUCCESS, $message, $additional);
        return $this;
    }
    public function error($message, $additional = NULL)
    {
        $this->log(ERROR, $message, $additional);
        return $this;
    }
    public function info($message, $additional = NULL)
    {
        $this->log(INFO, $message, $additional);
        return $this;
    }
    protected function log($type, $message, $additional = NULL)
    {
        try {
            $model = new \ModulesGarden\Servers\ZimbraEmail\Core\Queue\Models\JobLog();
            $model->job_id = $this->job->id;
            $model->type = $type;
            $model->message = $message;
            $model->additional = serialize($additional);
            $model->save();
        } catch (\Exception $ex) {
            var_dump($ex->getMessage());
            return $this;
        }
    }
}

?>