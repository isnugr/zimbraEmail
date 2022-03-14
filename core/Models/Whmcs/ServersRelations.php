<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs;

/**
 * Description of ServersRelations
 *
 * @author Mateusz Pawłowski <mateusz.pa@moduelsgarden.com>
 *
 * @property int $groupid
 * @property int $serverid
 */
class ServersRelations extends \Illuminate\Database\Eloquent\model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "tblservergroupsrel";
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    public function servers()
    {
        return $this->hasOne("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\Servers", "id", "serverid");
    }
    public function group()
    {
        return $this->hasOne("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\ServersGroups", "id", "serverid");
    }
}

?>