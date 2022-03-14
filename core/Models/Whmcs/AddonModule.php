<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs;

/**
 * Description of AddonModule
 *
 * @var int id
 * @var string module
 * @var string setting
 * @var string value
 *
 * @author Paweł Złamaniec <pawel.zl@modulesgarden.com>
 */
class AddonModule extends \Illuminate\Database\Eloquent\Model
{
    /**
     * Table name
     * @var string
     */
    protected $table = "tbladdonmodules";
    /**
     * Key
     * @var type 
     */
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
    protected $fillable = ["module", "setting", "value"];
    /**
     * Indicates if the model should soft delete.
     * @var bool
     */
    protected $softDelete = false;
    /**
     * Indicates if the model should be timestamped.
     * @var bool
     */
    public $timestamps = false;
}

?>