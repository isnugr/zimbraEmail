<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Sections;

/**
 * Class AddOwnersDistribuition
 * User: Nessandro
 * Date: 2019-09-20
 * Time: 12:43
 */
class AddOwnersDistribution extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Sections\FreeFieldsSection
{
    protected $id = "addOwnersDistribution";
    protected $name = "addOwnersDistribution";
    public function initContent()
    {
        $this->addField((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Tagger("owners"))->setPlaceholder(ModulesGarden\Servers\ZimbraEmail\Core\Helper\di("lang")->absoluteT("mail@example.com"))->addValidator(new \ModulesGarden\Servers\ZimbraEmail\App\Validators\TaggerEmailValidator()));
    }
}

?>