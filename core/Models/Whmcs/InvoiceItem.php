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
class InvoiceItem extends \Illuminate\Database\Eloquent\Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "tblinvoiceitems";
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
    protected $fillable = ["invoiceid", "userid", "type", "relid", "description", "amount", "taxed", "duedate", "paymentmethod", "notes"];
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
    public function client()
    {
        return $this->hasOne("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\Client", "id", "userid");
    }
    public function invoice()
    {
        return $this->belongsTo("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\Invoice", "invoiceid");
    }
    public function hosting()
    {
        return $this->hasOne("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\Hosting", "id", "relid");
    }
    public function hostingAddon()
    {
        return $this->hasOne("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\HostingAddon", "id", "relid");
    }
    public function domain()
    {
        return $this->hasOne("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\Domain", "id", "relid");
    }
    public function upgrade()
    {
        return $this->hasOne("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\Upgrade", "id", "relid");
    }
}

?>