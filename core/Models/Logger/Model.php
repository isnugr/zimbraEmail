<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Models\Logger;

/**
 * Description of Model
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class Model extends \ModulesGarden\Servers\ZimbraEmail\Core\Models\ExtendedEloquentModel
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "Logger";
    protected $primaryKey = "id";
    /**
     * Eloquent guarded parameters
     * @var array
     */
    protected $guarded = ["id"];
    /**
     * Eloquent fillable parameters
     * @var array
     */
    protected $fillable = ["id", "id_ref", "id_type", "type", "level", "request", "response", "before_vars", "vars", "date"];
    protected $dates = ["date"];
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
    public function reference()
    {
        return $this->belongsTo($this->id_type, "id_ref")->first();
    }
    public function scopeJoinReference($query)
    {
        return $query->with("reference");
    }
}

?>