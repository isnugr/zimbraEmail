<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * Vue Components related functions
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface VueComponent
{
    protected $vueComponent = false;
    protected $defaultVueComponentName = NULL;
    protected static $vueComponentBody = "";
    protected static $listIdElements = [];
    protected static $vueComponentBodyJs = "";
    protected static $listIdElementsJs = [];
    protected static $vueComponentRegistrationsBody = NULL;
    protected static $vueComponentRegistrations = [];
    protected static $vueComponentRegistredIds = [];
    public function isVueComponent();
    public function getDefaultVueComponentName();
    public function getVueComponents();
    protected function addVueComponentTemplate($componentBody, $id);
    public function getVueComponentsJs();
    protected function addVueComponentJs($componentBodyJs, $id);
    protected function registerVueComponent($componentId, $componentTemplateId);
    public function getVueComponentsRegistrationsJs();
    public function getVueComponentsRegistrations();
    public function isVueRegistrationAllowed();
}

?>