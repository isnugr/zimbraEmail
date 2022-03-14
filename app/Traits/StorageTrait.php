<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Traits;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 05.09.19
 * Time: 14:13
 * Class Storage
 */
interface StorageTrait
{
    /**
     * @var \ModulesGarden\Servers\ZimbraEmail\App\Helpers\Storage
     */
    protected $storage = NULL;
    public function getStorage();
}

?>