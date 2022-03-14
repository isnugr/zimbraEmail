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
 * Date: 03.10.19
 * Time: 11:22
 * Class ParamsHandler
 */
interface ParamsHandler
{
    /**
     * @var array
     */
    protected $params = [];
    public function getParams();
    public function setParams($params);
}

?>