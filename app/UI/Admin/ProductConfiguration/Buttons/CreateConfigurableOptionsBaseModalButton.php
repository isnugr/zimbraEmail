<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\ProductConfiguration\Buttons;

/**
 * Class CreateConfigurableOptionsBaseModalButton
 * User: Nessandro
 * Date: 2019-09-29
 * Time: 15:29
 */
class CreateConfigurableOptionsBaseModalButton extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons\ButtonCreate implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea
{
    protected $id = "createCOBaseModalButton";
    protected $name = "createCOBaseModalButton";
    protected $title = "createCOBaseModalButton";
    protected $class = ["lu-btn lu-btn--success"];
    protected $htmlAttributes = ["href" => "javascript:;"];
    public function initContent()
    {
        $this->initLoadModalAction(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\ProductConfiguration\Modals\CreateConfigurableOptionsConfirm());
    }
}

?>