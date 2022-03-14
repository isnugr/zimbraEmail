<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Models\ProductSettings;

/**
 * Description of ModuleSettings
 * 
 * @var varchar(255) setting
 * @var text value
 * 
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class Model extends \ModulesGarden\Servers\ZimbraEmail\Core\Models\ExtendedEloquentModel
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "ProductSettings";
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
    protected $fillable = ["pid", "setting", "value"];
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
}

?>