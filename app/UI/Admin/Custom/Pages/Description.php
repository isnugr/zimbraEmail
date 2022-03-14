<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Pages;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 03.10.19
 * Time: 15:13
 * Class Description
 */
class Description extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\Alerts;
    protected $id = "description";
    protected $name = "description";
    protected $title = "description";
    protected $description = NULL;
    public function __construct($baseId = NULL, $hasAlert = false, $type = NULL)
    {
        parent::__construct($baseId);
        $this->setTitle($baseId . "PageTitle");
        $this->setDescription($baseId . "PageDescription");
        if ($hasAlert) {
            $this->addInternalAlert($baseId . "AlertDescription", $type);
        }
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    public function getAssetsUrl()
    {
        return \ModulesGarden\Servers\ZimbraEmail\Core\Helper\BuildUrl::getAssetsURL();
    }
    public function getIcon()
    {
        $asset = \ModulesGarden\Servers\ZimbraEmail\Core\Helper\BuildUrl::getAppAssetsURL();
        return $asset . DIRECTORY_SEPARATOR . "icons" . DIRECTORY_SEPARATOR . $this->id . ".png";
    }
}

?>