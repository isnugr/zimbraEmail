<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs;

/**
 * Description of Registrars
 *
 * @var id
 * @var registrar
 * @var setting
 * @var value
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class Registrars extends \Illuminate\Database\Eloquent\Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "tblregistrars";
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
    protected $fillable = ["registrar", "setting", "value"];
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
    public function getActiveList()
    {
        return $this->query()->getQuery()->select(["registrar"])->groupBy("registrar")->lists("registrar");
    }
}

?>