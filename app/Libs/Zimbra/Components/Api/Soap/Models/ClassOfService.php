<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 05.09.19
 * Time: 13:34
 * Class ClassOfService
 */
class ClassOfService extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Interfaces\AbstractModel
{
    protected $name = NULL;
    protected $id = NULL;
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getMbMailQuote()
    {
        $quete = $this->getDataResourceA("zimbraMailQuota");
        return $quete / 1024 / 1024;
    }
    public function getMailQuote()
    {
        $quete = $this->getDataResourceA("zimbraMailQuota");
        return $quete / 1024 / 1024;
    }
}

?>