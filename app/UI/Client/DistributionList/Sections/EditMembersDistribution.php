<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Sections;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 02.10.19
 * Time: 09:38
 * Class EditMembersDistribution
 */
class EditMembersDistribution extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Sections\FreeFieldsSection
{
    protected $id = "editMembersDistribution";
    protected $name = "editMembersDistribution";
    public function initContent()
    {
        $email = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Sections\InputGroup("usernameGroup");
        $email->addInputComponent((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\InputGroupElements\Text("listmail"))->addHtmlAttribute("readonly", "true"));
        $email->addInputAddon("emailSign", false, "@");
        $email->addInputComponent((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\InputGroupElements\Text("domain"))->addHtmlAttribute("readonly", "true"));
        $this->addSection($email);
        $this->addField(new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("displayName"));
        $this->addField(new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Textarea("description"));
        $this->addField((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Select("memberList"))->enableMultiple());
        $this->addField((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Tagger("customMember"))->setPlaceholder(ModulesGarden\Servers\ZimbraEmail\Core\Helper\di("lang")->absoluteT("mail@example.com"))->addValidator(new \ModulesGarden\Servers\ZimbraEmail\App\Validators\TaggerEmailValidator()));
        $this->addField(new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Hidden("id"));
        $this->addField((new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\ExtendedSelect("emailAliasesActually"))->enableMultiple()->enableHidden());
        $this->addField((new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\ExtendedSelect("memberListActually"))->enableMultiple()->enableHidden());
        $this->addField((new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\ExtendedSelect("ownersActually"))->enableMultiple()->enableHidden());
    }
}

?>