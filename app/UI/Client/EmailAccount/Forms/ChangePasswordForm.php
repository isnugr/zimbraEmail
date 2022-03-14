<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Forms;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 08.11.19
 * Time: 12:07
 * Class ChangePasswordForm
 */
class ChangePasswordForm extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\BaseForm implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "changePasswordForm";
    protected $name = "changePasswordForm";
    protected $title = "changePasswordForm";
    protected function getDefaultActions()
    {
        return ["changePassword"];
    }
    public function initContent()
    {
        $this->setFormType("changePassword");
        $this->dataProvider = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Providers\EditAccountDataProvider();
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Hidden("id");
        $this->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\Customs\Fields\TextWithButton("password");
        $field->setDescription("description");
        $field->addHtmlAttribute("onkeyup", "calculatePasswordStr()");
        $field->addValidator(new \ModulesGarden\Servers\ZimbraEmail\App\Validators\CustomPasswordValidator());
        $field->notEmpty();
        $field->addButton(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\Customs\Buttons\GeneratePassword());
        $this->addField($field);
        $this->loadDataToForm();
    }
}

?>