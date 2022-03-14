<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms;

/**
 * FormIntegration controller
 *
 * This form does not contain a <form> tag, this is correct for implementing a FW form functionalities
 * to fields and sections that are injected into already existing WHMCS forms.
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class FormIntegration extends BaseStandaloneForm
{
    protected $id = "formIntegration";
    protected $name = "formIntegration";
    protected function preInitContent()
    {
        $this->setSubmit(NULL);
        $formAction = new Fields\Hidden("mgformtype");
        $formAction->setDefaultValue(FormConstants::UPDATE);
        $this->addField($formAction);
        $formAction = new Fields\Hidden("ajax");
        $formAction->setDefaultValue(1);
        $this->addField($formAction);
    }
}

?>