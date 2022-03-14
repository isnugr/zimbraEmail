<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs;

/**
 * Description of Cancel Request
 *
 * @var int id
 * @var datetime date
 * @var int relid
 * @var string reason
 * @var string type
 * @var timestamp created_at
 * @var timestamp updated_at
 *
 * @author Paweł Złamaniec <pawel.zl@modulesgarden.com>
 */
class CancelRequest extends \Illuminate\Database\Eloquent\Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "tblcancelrequests";
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
    protected $fillable = ["date", "relid", "reason", "type", "created_at", "updated_at"];
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
    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
    }
}

?>