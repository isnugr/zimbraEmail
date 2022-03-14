<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Sections;

/**
 * Class AddPropertiesDistribution
 * User: Nessandro
 * Date: 2019-09-20
 * Time: 12:42
 */
class AddPropertiesDistribution extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Sections\FreeFieldsSection
{
    protected $id = "addPropertiesDistribution";
    protected $name = "addPropertiesDistribution";
    public function initContent()
    {
        $this->addField(new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("receiveMail"));
        $this->addField(new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("hideGal"));
        $this->addField((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("dynamicGroup"))->addHtmlAttribute("@change", "initReloadModal()"));
        $this->addField(new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Select("subscriptionRequest"));
        $this->addField(new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Select("unsubscriptionRequest"));
        $this->addField(new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("sharesNotify"));
    }
}

?>