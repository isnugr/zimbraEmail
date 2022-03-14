<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * Main Container Elements related functions
 * Main Container Trait
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface MainContainerElements
{
    protected $ajaxElements = [];
    protected $vueComponents = [];
    protected $header = [];
    protected $footer = [];
    protected $navbar = NULL;
    public function addAjaxElement(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AjaxElementInterface $element);
    public function addVueComponent($element);
    protected function prepareElemnentsContainers();
    public function loadDefaultNavbars();
}

?>