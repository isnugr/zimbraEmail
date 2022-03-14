<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

interface Template
{
    protected $templateName = NULL;
    protected $templateDir = NULL;
    protected $defaultTemplateName = "container";
    protected $templateSet = NULL;
    protected $templateScope = NULL;
    protected $templateMainDir = NULL;
    protected $customTplVars = [];
    public function getTemplateDir();
    public function getDefaultTemplateDir();
    public function changeTemplateSet($templateSet);
    public function getTemplateName();
    protected function loadTemplateVars();
    protected function setScopes();
    protected function checkAdmin();
    protected function loadSet();
    protected function loadMainDir();
    protected function loadTemplateName();
    protected function loadTemplateDir();
    protected function getBasePatch($pathParts, $isCore);
    protected function getBaseCorePatch($pathParts);
    protected function getBaseAppPatch($pathParts);
    protected function evaluateTemplatePath();
    public function getCustomTplVars();
    public function getCustomTplVarsValue($varName);
    public function setTemplate($patch, $tpl);
}

?>