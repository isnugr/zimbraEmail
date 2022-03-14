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
 * Date: 18.09.19
 * Time: 09:29
 * Class EditAccountForm
 */
class EditAccountForm extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Forms\SortedFieldForm implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    use \ModulesGarden\Servers\ZimbraEmail\App\Traits\FormExtendedTrait;
    protected $id = "editAccountForm";
    protected $name = "editAccountForm";
    protected $title = "editAccountForm";
    public function initContent()
    {
        $this->setFormType(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\FormConstants::UPDATE);
        $this->setProvider(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Providers\EditAccountDataProvider());
        $this->initFields();
        $this->loadDataToForm();
    }
    public function initFields()
    {
        $this->addSection(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Sections\EditGeneralSection());
        $this->addSection(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Sections\EditAdditionalSection());
    }
}

?>