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
 * Date: 11.09.19
 * Time: 14:24
 * Class ConfigTrait
 */
interface ConfigTrait
{
    /**
     * @var array
     */
    private $config = [];
    public function set($name, $value);
    public function get($name, $default);
    public function update($name, $value);
    public function remove($name);
    public function exists($name);
}

?>