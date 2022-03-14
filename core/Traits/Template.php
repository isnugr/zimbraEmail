<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Traits;

interface Template
{
    protected $templateName = NULL;
    protected $templateDir = NULL;
    public function getTemplateDir();
    public function getTemplateName();
    public function setTemplateName($templateName);
    public function setTemplateDir($templateDir);
}

?>