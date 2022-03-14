<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Models;

/**
 * Description of Crontabs
 *
 * @author inbs
 */
class CronTabs extends ExtendedEloquentModel
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "CronTabs";
    protected $primaryKey = "name";
    /**
     * Eloquent guarded parameters
     * @var array
     */
    protected $guarded = ["name"];
    /**
     * Eloquent fillable parameters
     * @var array
     */
    protected $fillable = ["name", "status", "created", "params", "errors"];
    protected $dates = ["created"];
    /**
     * Indicates if the model should soft delete.
     *
     * @var bool
     */
    protected $softDelete = false;
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    const DEFAULT_CRON_MANAGER_NAME = "DefaultCronManagerName";
    public function getErrorsAttribute($value)
    {
        return json_decode($value);
    }
    public function setErrorsAttribute($value)
    {
        $this->attributes["errors"] = json_encode($value);
        return $this;
    }
    public function getParamsAttribute($value)
    {
        return json_decode($value);
    }
    public function setParamsAttribute($value)
    {
        $this->attributes["params"] = json_encode($value);
        return $this;
    }
    public function scopeStatusError($query)
    {
        return $query->where("status", "LIKE", "error");
    }
    public function scopeStatusReboot($query)
    {
        return $query->where("status", "LIKE", "reboot");
    }
    public function scopeStatusStart($query)
    {
        return $query->where("status", "LIKE", "start");
    }
    public function scopeStatusStop($query)
    {
        return $query->where("status", "LIKE", "stop");
    }
    public function scopeIfName($query, $name = "")
    {
        return $query->where("name", "LIKE", $name);
    }
    public function scopeIfDefaultCronManager($query)
    {
        return $query->where("name", "LIKE", "DefaultCronManagerName");
    }
    public function scopeUpdateStatus($query, $status = "stop", $params = [])
    {
        return $query->update(["status" => $status, "params" => json_encode($params)]);
    }
    public function scopeAddError($query, $errorMessage = "")
    {
        $errorList = $this->errors;
        $errorList[] = $errorMessage;
        return $query->update(["errors" => json_encode($errorList), "status" => "error"]);
    }
    public function scopeCleanErrors($query)
    {
        $errorList = [];
        return $query->update(["errors" => json_encode($errorList)]);
    }
}

?>