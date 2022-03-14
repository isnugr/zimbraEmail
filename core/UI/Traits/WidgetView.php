<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * Title elements related functions
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface WidgetView
{
    protected $isViewHeader = true;
    protected $isViewFooter = true;
    protected $isViewTopBody = true;
    public function enabledViewHeader();
    public function disabledViewHeader();
    public function isViewHeader();
    public function enabledViewFooter();
    public function disabledViewFooter();
    public function isViewFooter();
    public function enabledViewTopBody();
    public function disabledViewTopBody();
    public function isViewTopBody();
}

?>