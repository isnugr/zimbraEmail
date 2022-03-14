<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Queue\Models;

/**
 * Class Job
 * @package ModulesGarden\Servers\ZimbraEmail\Core\Job\Models
 * @property $job job id
 * @property $jobId
 * @property $id
 * @property $date -
 * @property $message -
 * @property $type
 * @property $additional - serialized
 */
class JobLog extends \ModulesGarden\Servers\ZimbraEmail\Core\Models\ExtendedEloquentModel
{
    /**
     * @var string
     */
    protected $table = "JobLog";
    public function job()
    {
        return $this->hasOne("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Queue\\Models\\Job", "job_id");
    }
}

?>