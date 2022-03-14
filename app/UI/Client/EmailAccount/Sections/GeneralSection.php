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
 * Time: 13:39
 * Class GeneralSection
 */
class GeneralSection extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Sections\FreeFieldsSection
{
    use \ModulesGarden\Servers\ZimbraEmail\App\Traits\FormExtendedTrait;
    protected $id = "generalSection";
    protected $name = "generalSection";
    public function initContent()
    {
        $hid = $this->getRequestValue("id");
        $productManager = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Product\ProductManager();
        $productManager->loadByHostingId($hid);
        $this->generateDoubleSection([(new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("firstname"))->notEmpty(), (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("lastname"))->notEmpty()]);
        $email = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Sections\InputGroup("usernameGroup");
        $email->addTextField("username", false, true);
        $email->addInputAddon("emailSign", false, "@");
        $email->addInputComponent((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\InputGroupElements\Text("domain"))->addHtmlAttribute("readonly", "true"));
        $this->addSection($email);
        $this->generateDoubleSection([new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("display_name"), new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Select("status")]);
        if ($productManager->get("cos_name") === \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository\ClassOfServices::CLASS_OF_SERVICE_QUOTA) {
            $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Select("cosId");
            $this->addField($field);
        } else {
            if ($productManager->get("cos_name") === \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository\ClassOfServices::ZIMBRA_CONFIG_OPTIONS) {
                $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Hidden("cosId");
                $this->addField($field);
            } else {
                if ($productManager->get("cos_name") !== \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository\ClassOfServices::CUSTOM_ZIMBRA) {
                    $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Hidden("cosId");
                    $this->addField($field);
                }
            }
        }
        $passwd = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\Customs\Fields\TextWithButton("password");
        $passwd->setDescription("description");
        $passwd->addHtmlAttribute("onkeyup", "calculatePasswordStr()");
        $passwd->addButton(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\Customs\Buttons\GeneratePassword());
        $passwd->addValidator(new \ModulesGarden\Servers\ZimbraEmail\App\Validators\CustomPasswordValidator());
        $passwd->notEmpty();
        $this->addField($passwd);
    }
}

?>