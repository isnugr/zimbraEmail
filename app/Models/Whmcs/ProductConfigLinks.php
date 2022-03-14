<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Models\Whmcs;

/**
 * Description of ProductConfigLinks
 *
 * @author Mateusz Pawłowski <mateusz.pa@moduelsgarden.com>
 *
 * @property int $gid
 * @property int $pid
 */
class ProductConfigLinks extends \Illuminate\Database\Eloquent\model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "tblproductconfiglinks";
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    public function groups()
    {
        return $this->hasOne("ModulesGarden\\Servers\\ZimbraEmail\\App\\Models\\Whmcs\\ProductConfigGroups", "id", "gid");
    }
    public function product()
    {
        return $this->hasOne("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\Product", "id", "pid");
    }
}

?>