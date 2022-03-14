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
class Hosting extends \Illuminate\Database\Eloquent\Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "tblhosting";
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
    protected $fillable = ["userid", "orderid", "packageid", "server", "regdate", "domain", "paymentmethod", "firstpaymentamount", "amount", "billingcycle", "nextduedate", "nextinvoicedate", "termination_date", "completed_date", "domainstatus", "username", "password", "notes", "subscriptionid", "promoid", "suspendreason", "overideautosuspend", "overidesuspenduntil", "dedicatedip", "assignedips", "ns1", "ns2", "diskusage", "disklimit", "bwusage", "bwlimit", "lastupdate"];
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
    public function product()
    {
        return $this->belongsTo("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\Product", "packageid");
    }
    public function addons()
    {
        return $this->hasMany("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\HostingAddon", "hostingid");
    }
    public function client()
    {
        return $this->belongsTo("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\Client", "userid");
    }
    public function configOptions()
    {
        return $this->hasMany("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\HostingConfigOption", "relid");
    }
    public function server()
    {
        return $this->belongsTo("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\Server", "server");
    }
    public function order()
    {
        return $this->belongsTo("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\Order", "orderid");
    }
    public function cancelation()
    {
        return $this->hasOne("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\CancelRequest", "relid");
    }
    public function getBillingcycleFriendlyAttribute()
    {
        return $this->attributes["billingcycle"];
    }
}

?>