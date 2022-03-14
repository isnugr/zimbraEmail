<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Models\Tasks;

/**
 * Class Task
 * @property $status
 * @property job_id
 * @property $model
 * @property $namespace
 * @property $rel_id
 * @package ModulesGarden\Servers\ZimbraEmail\Core\Models\Tasks
 */
class Task extends \ModulesGarden\Servers\ZimbraEmail\Core\Models\ExtendedEloquentModel
{
    /**
     * @var null
     */
    protected $model = NULL;
    const CANCELLED = "cancelled";
    const FINISHED = "finished";
    const STARTED = "started";
    const PENDING = "pending";
    public function finish()
    {
        $this->setStatus(FINISHED);
        return $this;
    }
    public function cancel()
    {
        $this->setStatus(CANCELLED);
        return $this;
    }
    public function pending()
    {
        $this->setStatus(PENDING);
        return $this;
    }
    public function start()
    {
        $this->setStatus(STARTED);
        return $this;
    }
    public function setStatus($status)
    {
        $this->status = $status;
        $this->save();
        return $this;
    }
    public function setJobId($id)
    {
        $this->job_id = $id;
        $this->save();
        return $this;
    }
    public function model()
    {
        if (!$this->model) {
            $this->model = new $this->namespace($this->rel_id);
        }
        return $this->model;
    }
}

?>