<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\ProductConfiguration\Pages\Sections;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 29.08.19
 * Time: 08:35
 * Class MimeFeatures
 */
class MimeFeatures extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Sections\BoxSectionExtended implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea
{
    protected $id = "mimeFeatures";
    protected $name = "mimeFeatures";
    protected $title = "mimeFeatures";
    public function initContent()
    {
        $this->addSection($this->getLeftSection());
    }
    public function getLeftSection()
    {
        $left = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Sections\HalfPageSection("left");
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeatureSMIMEEnabled");
        $left->addField($field);
        return $left;
    }
}

?>