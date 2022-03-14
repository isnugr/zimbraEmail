<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\Home\Fields;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 03.10.19
 * Time: 14:37
 * Class FeatureField
 */
class FeatureField extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\BaseField implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "featureField";
    protected $name = "featureField";
    protected $url = NULL;
    protected $targetBlank = false;
    public function getUrl()
    {
        return $this->url;
    }
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }
    public function getIcon()
    {
        $asset = \ModulesGarden\Servers\ZimbraEmail\Core\Helper\BuildUrl::getAppAssetsURL();
        return $asset . DIRECTORY_SEPARATOR . "icons" . DIRECTORY_SEPARATOR . $this->id . ".png";
    }
    public function isTargetBlank()
    {
        return $this->targetBlank;
    }
    public function setTargetBlank($targetBlank)
    {
        $this->targetBlank = $targetBlank;
        return $this;
    }
}

?>