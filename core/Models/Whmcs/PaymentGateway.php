<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs;

/**
 * Description of Product
 *
 * @author Paweł Złamaniec <pawel.zl@modulesgarden.com>
 */
class PaymentGateway extends \Illuminate\Database\Eloquent\Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "tblpaymentgateways";
    protected $primaryKey = "gateway";
    /**
     * Eloquent guarded parameters
     * @var array
     */
    protected $guarded = ["gateway"];
    /**
     * Eloquent fillable parameters
     * @var array
     */
    protected $fillable = ["gateway", "setting", "value", "order"];
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
    public function scopeGetNameByGateway($query, $gateway)
    {
        return $query->where("setting", "name")->where("gateway", $gateway);
    }
}

?>