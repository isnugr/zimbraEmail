<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

interface HtmlElements
{
    protected $class = [];
    protected $name = NULL;
    protected $id = NULL;
    protected $scriptHtml = NULL;
    protected $index = NULL;
    public function setName($name);
    public function addClass($class);
    public function removeClass($class);
    public function replaceClasses($classes);
    public function getClasses();
    public function hasClass($class);
    public function setId($id);
    public function setScriptHtml($scriptHtml);
    protected function generateRandomId();
    protected function generateRandomName();
    public function getName();
    public function getId();
    public function getRawClasses();
    public function getScriptHtml();
    protected function prepareDefaultHtmlElements();
    public function initIds($id);
    public function isIdEqual($id);
    public function getIndex();
    public function setIndex($index);
}

?>