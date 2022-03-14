<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Sections;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 12.11.19
 * Time: 13:52
 * Class EditGeneralSection
 */
class EditGeneralSection extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Sections\FreeFieldsSection
{
    use \ModulesGarden\Servers\ZimbraEmail\App\Traits\FormExtendedTrait;
    protected $id = "editGeneralSection";
    protected $name = "editGeneralSection";
    public function initContent()
    {
        $hid = $this->getRequestValue("id");
        $productManager = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Product\ProductManager();
        $productManager->loadByHostingId($hid);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Hidden("id");
        $this->addField($field);
        $this->generateDoubleSection([new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("firstname"), new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("lastname")]);
        $email = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Sections\InputGroup("usernameGroup");
        $email->addInputComponent((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\InputGroupElements\Text("username"))->addHtmlAttribute("readonly", "true"));
        $email->addInputAddon("emailSign", false, "@");
        $email->addInputComponent((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\InputGroupElements\Text("domain"))->addHtmlAttribute("readonly", "true"));
        $this->addSection($email);
        $this->generateDoubleSection([new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("display_name"), new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Select("status")]);
        if ($productManager->get("cos_name") === \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository\ClassOfServices::CLASS_OF_SERVICE_QUOTA) {
            $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Hidden("currentCosId");
            $this->addField($field);
            $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Select("cosId");
            $this->addField($field);
        }
    }
}

?>