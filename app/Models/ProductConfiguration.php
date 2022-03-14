<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Models;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 09.09.19
 * Time: 11:07
 * Class ProductConfiguration
 */
class ProductConfiguration extends \ModulesGarden\Servers\ZimbraEmail\Core\Models\ExtendedEloquentModel
{
    protected $table = "product_configuration";
    protected $primaryKey = "id";
    protected $guarded = ["id"];
    protected $fillable = ["product_id", "setting", "value"];
    protected $softDelete = false;
    public $timestamps = false;
}

?>