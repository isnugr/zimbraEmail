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
class Pricing extends \Illuminate\Database\Eloquent\Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "tblpricing";
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
    protected $fillable = ["type", "currency", "currencyModel", "relid", "msetupfee", "qsetupfee", "ssetupfee", "asetupfee", "bsetupfee", "tsetupfee", "monthly", "quarterly", "semiannually", "annually", "biennially", "triennially"];
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
    public function domainPricing()
    {
        $this->whereIn("tblpricing.type", ["domaintransfer", "domainrenew", "domainregister"]);
        return $this;
    }
    public function currencyModel()
    {
        return $this->belongsTo("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\Currency", "currency");
    }
}

?>