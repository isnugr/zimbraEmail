<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\ProductConfiguration\Forms;

/**
 * Class CreateConfigurableAction
 * User: Nessandro
 * Date: 2019-09-29
 * Time: 15:31
 */
class CreateConfigurableAction extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Forms\BaseFormExtended implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea
{
    protected $id = "createConfigurableAction";
    protected $name = "createConfigurableAction";
    protected $title = "createConfigurableAction";
    public function initContent()
    {
        $lang = ModulesGarden\Servers\ZimbraEmail\Core\Helper\di("lang");
        $lang->addReplacementConstant("configurableOptionsNameUrl", "<a style=\"    color: #31708f; text-decoration: underline;\" href=\"https://docs.whmcs.com/Addons_and_Configurable_Options\" target=\"blank\">here</a>");
        $this->addInternalAlert($lang->absoluteT("configurableOptionsWhmcsInfo"), "info", NULL, true);
        $this->setFormType(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\FormConstants::CREATE);
        $this->setProvider(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\ProductConfiguration\Providers\ConfigurableOptionManager());
        $this->loadDataToForm();
        $dataProvider = $this->getFormData();
        if (is_array($dataProvider["fields"])) {
            foreach ($dataProvider["fields"] as $key => $name) {
                $this->addField((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher($key))->setDefaultValue("on")->setRawTitle($key . "|" . $name));
            }
        }
        $this->loadDataToForm();
    }
}

?>