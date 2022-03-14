<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs;

/**
 * Description of ServersGroups
 *
 * @author Mateusz Pawłowski <mateusz.pa@moduelsgarden.com>
 *s
 * @property int $id
 * @property string $name
 * @property int $filltype
 */
class ServersGroups extends \Illuminate\Database\Eloquent\model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "tblservergroups";
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}

?>