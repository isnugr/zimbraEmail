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
class Product extends \Illuminate\Database\Eloquent\Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "tblproducts";
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
    protected $fillable = ["type", "gid", "name", "description", "hidden", "showdomainoptions", "welcomemail", "stockcontrol", "qty", "proratabilling", "proratadate", "proratachargenextmonth", "paytype", "allowqty", "subdomain", "autosetup", "servertype", "servergroup", "configoption1", "configoption2", "configoption3", "configoption4", "configoption5", "configoption6", "configoption7", "configoption8", "configoption9", "configoption10", "configoption11", "configoption12", "configoption13", "configoption14", "configoption15", "configoption16", "configoption17", "configoption18", "configoption19", "configoption20", "configoption21", "configoption22", "configoption23", "configoption24", "freedomain", "freedomainpaymentterms", "freedomaintlds", "recurringcycles", "autoterminatedays", "autoterminateemail", "configoptionsupgrade", "billingcycleupgrade", "upgradeemail", "overagesenabled", "overagesdisklimit", "overagesbwlimit", "overagesdiskprice", "overagesbwprice", "tax", "affitiatepaytype", "affiliateonetime", "affiliatepayamount", "order", "retired", "is_featured"];
    protected $date = ["created_at", "updated_at"];
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
    public function group()
    {
        return $this->belongsTo("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\ProductGroup", "gid");
    }
    public function upgrades()
    {
        return $this->hasMany("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\ProductUpgrade", "product_id");
    }
}

?>