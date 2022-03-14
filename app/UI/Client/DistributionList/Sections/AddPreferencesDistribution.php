<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Sections;

class AddPreferencesDistribution extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Sections\FreeFieldsSection
{
    protected $id = "addPreferencesDistribution";
    protected $name = "addPreferencesDistribution";
    public function initContent()
    {
        $this->addField(new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("replyEmail"));
        $this->addField(new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("replyDisplayName"));
        $this->addField((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("replyEmailAddress"))->setPlaceholder(ModulesGarden\Servers\ZimbraEmail\Core\Helper\di("lang")->absoluteT("mail@example.com")));
    }
}

?>