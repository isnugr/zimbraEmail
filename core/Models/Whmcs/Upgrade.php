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
class Upgrade extends \Illuminate\Database\Eloquent\Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "tblupgrades";
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
    protected $fillable = ["userid", "orderid", "type", "date", "relid", "originalvalue", "newvalue", "new_cycle", "amount", "credit_amount", "days_remaining", "total_days_in_cycle", "new_recurring_amount", "recurringchange", "status", "paid"];
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
    public function order()
    {
        return $this->belongsTo("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\Order", "orderid");
    }
    public function hosting()
    {
        if ($this->type != "package") {
            return new \stdClass();
        }
        return $this->belongsTo("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\Hosting", "relid");
    }
    public function productFrom()
    {
        if ($this->type != "package") {
            return new \stdClass();
        }
        return $this->belongsTo("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\Product", "originalvalue");
    }
    public function getNewBillingcycleAttribute()
    {
        $newvalue = explode(",", $this->newvalue);
        return $newvalue[1];
    }
}

?>