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
 * Time: 13:42
 * Class AdditionalSection
 */
class AdditionalSection extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Sections\FreeFieldsSection
{
    use \ModulesGarden\Servers\ZimbraEmail\App\Traits\FormExtendedTrait;
    protected $id = "additionalSection";
    protected $name = "additionalSection";
    public function initContent()
    {
        $this->generateDoubleSection([new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("company"), new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("title")]);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("phone");
        $field->setPlaceholder(ModulesGarden\Servers\ZimbraEmail\Core\Helper\di("lang")->absoluteT("phoneNumberPlaceholder"));
        $this->addField($field);
        $this->generateDoubleSection([new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("home_phone"), new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("mobile_phone")]);
        $this->generateDoubleSection([new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("fax"), new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("pager")]);
        $this->generateDoubleSection([new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("country"), new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("state")]);
        $this->generateDoubleSection([new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("city"), new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("street")]);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("post_code");
        $this->addField($field);
    }
}

?>