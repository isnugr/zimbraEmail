<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\ProductConfiguration\Pages;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 28.08.19
 * Time: 09:12
 * Class ConfigForm
 */
class ConfigForm extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\FormIntegration implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea
{
    protected $id = "configForm";
    protected $name = "configForm";
    protected $title = "configForm";
    public function initContent()
    {
        $this->setProvider(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\ProductConfiguration\Providers\ProductConfigurationDataProvider());
        $this->addSection(new Sections\ZimbraSettings());
        $this->addSection(new Sections\EssentialFeatures());
        $this->addSection(new Sections\GeneralFeatures());
        $this->addSection(new Sections\MailServiceFeatures());
        $this->addSection(new Sections\ContactFeatures());
        $this->addSection(new Sections\CalendarFeatures());
        $this->addSection(new Sections\SearchFeatures());
        $this->addSection(new Sections\MimeFeatures());
        $this->addSection(new Sections\ClassOfServiceFeatures());
        $this->addSection(new Sections\PasswordFeatures());
        $this->addSection(new Sections\ClientAreaFeatures());
        $this->addSection(new Sections\ConfigurableOptions());
        $this->loadDataToForm();
    }
}

?>