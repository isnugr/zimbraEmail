<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * App Layouts related functions
 * View Trat
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface AppLayouts
{
    protected $appLayout = \ModulesGarden\Servers\ZimbraEmail\Core\UI\Helpers\AppLayoutConstants::NAVBAR_TOP;
    public function getAppLayout();
    public function setAppLayout($layout);
    public function getAppLayoutTemplateDir();
}

?>