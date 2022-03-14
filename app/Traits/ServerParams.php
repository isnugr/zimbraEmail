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
 * Date: 09.09.19
 * Time: 13:53
 * Class ServerParams
 */
interface ServerParams
{
    public function getServerParamsByProductId($id);
    public function getServerParamsByHostingId($id);
    public function getServerParamsById($id);
}

?>