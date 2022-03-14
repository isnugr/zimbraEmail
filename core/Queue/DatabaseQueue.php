<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Queue;

class DatabaseQueue implements \Illuminate\Contracts\Queue\Queue
{
    public function push($job, $data = "", $queue = "default")
    {
        $model = new Models\Job();
        $model->job = $job;
        $model->data = $data;
        $model->queue = $queue;
        $model->save();
    }
    public function pushRaw($payload, $queue = NULL, $options = [])
    {
    }
    public function later($delay, $job, $data = "", $queue = NULL)
    {
    }
    public function pushOn($queue, $job, $data = "")
    {
    }
    public function laterOn($queue, $delay, $job, $data = "")
    {
    }
    public function pop($queue = "default")
    {
        return Models\Job::where("queue", $queue)->where(function ($query) {
            $query->where("status", "=", "")->orWhere(function ($query) {
                $query->where("status", "=", Models\Job::STATUS_ERROR);
                $query->whereRaw("retry_after < NOW()");
                $query->where("retry_count", "<", "100");
            })->orWhere(function ($query) {
                $query->where("status", "=", Models\Job::STATUS_WAITING);
                $query->whereRaw("retry_after < NOW()");
                $query->where("retry_count", "<", "100");
            });
        })->first();
    }
}

?>