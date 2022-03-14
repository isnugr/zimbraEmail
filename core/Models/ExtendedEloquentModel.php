<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Models;

/**
 * Wrapper for EloquentModel
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class ExtendedEloquentModel extends \Illuminate\Database\Eloquent\Model
{
    public function __construct($attributes = [])
    {
        $this->table = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getPrefixDataBase() . $this->table;
        parent::__construct($attributes);
    }
}

?>