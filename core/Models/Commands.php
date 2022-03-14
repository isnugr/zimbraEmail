<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Models;

/**
 * Class Commands
 * @property $uuid
 * @property $name
 * @property $parent_uuid
 * @property $status
 * @property $action
 * @package ModulesGarden\Servers\ZimbraEmail\Core\Models
 */
class Commands extends ExtendedEloquentModel
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "Commands";
    /**
     * @var string
     */
    protected $primaryKey = "name";
    const STATUS_STOPPED = "stopped";
    const STATUS_RUNNING = "running";
    const STATUS_ERROR = "error";
    const STATUS_SLEEPING = "sleeping";
    const ACTION_START = "start";
    const ACTION_STOP = "stop";
    const ACTION_REBOOT = "reboot";
    const ACTION_NONE = "none";
    public function isStopped()
    {
        return $this->status === STATUS_STOPPED;
    }
    public function isRunning()
    {
        return $this->status === STATUS_RUNNING;
    }
    public function isSleeping()
    {
        return $this->status === STATUS_SLEEPING;
    }
    public function setRunning()
    {
        $this->setStatus(STATUS_RUNNING);
        return $this;
    }
    public function setStopped()
    {
        $this->setStatus(STATUS_STOPPED);
        return $this;
    }
    public function setSleeping()
    {
        $this->setStatus(STATUS_SLEEPING);
        return $this;
    }
    public function setStatus($status)
    {
        $this->status = $status;
        $this->save();
        return $this;
    }
    public function start()
    {
        $this->setAction(ACTION_START);
        return $this;
    }
    public function stop()
    {
        $this->setAction(ACTION_STOP);
        return $this;
    }
    public function reboot()
    {
        $this->setAction(ACTION_REBOOT);
        return $this;
    }
    public function ping()
    {
        $this->save();
    }
    public function clearAction()
    {
        $this->setAction(ACTION_NONE);
        return $this;
    }
    public function setAction($action)
    {
        $this->action = $action;
        $this->save();
        return $this;
    }
    public function shouldBeStopped()
    {
        return $this->action === ACTION_STOP;
    }
    public function shouldBeRestared()
    {
        return $this->action === ACTION_REBOOT;
    }
}

?>