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
class ProductConfigOption extends \Illuminate\Database\Eloquent\Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "tblproductconfigoptions";
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
    protected $fillable = ["gid", "optionname", "optiontype", "qtyminimum", "qtymaximum", "order", "hidden"];
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
    public function links()
    {
        return $this->hasMany("ModulesGarden\\Servers\\ZimbraEmail\\App\\Models\\Whmcs\\ProductConfigLinks", "gid", "gid");
    }
    public function suboptions()
    {
        return $this->hasMany("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\ProductConfigOptionSub", "configid");
    }
    public function isLinkedToProduct($id)
    {
        foreach ($this->links as $link) {
            if ((int) $link->pid === (int) $id) {
                return true;
            }
        }
        return false;
    }
}

?>