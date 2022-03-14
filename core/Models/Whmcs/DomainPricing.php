<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs;

/**
 * Description of Domain Pricing
 *
 * @var id
 * @var extension
 * @var dnsmanagement
 * @var emailforwarding
 * @var idprotection
 * @var eppcode
 * @var autoreg
 * @var order
 * @var group
 *
 * @author Paweł Złamaniec <pawel.zl@modulesgarden.com>
 */
class DomainPricing extends \Illuminate\Database\Eloquent\Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "tbldomainpricing";
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
    protected $fillable = ["id", "extension", "dnsmanagement", "emailforwarding", "idprotection", "eppcode", "autoreg", "order", "group"];
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
    public function getExtensionNoDotAttribute()
    {
        return substr($this->extension, 1);
    }
    public function scopeWithPrincing($query)
    {
        return $query->join("tblpricing", function ($join) {
            $join->on("tbldomainpricing.id", "LIKE", "tblpricing.relid");
        });
    }
    public function scopeGroupByExtension($query)
    {
        return $query->groupBy("tbldomainpricing.extension");
    }
}

?>