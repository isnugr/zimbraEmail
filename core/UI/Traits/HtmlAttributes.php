<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * Html Attributes related functions
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface HtmlAttributes
{
    protected $htmlAttributes = [];
    public function getHtmlAttributes();
    public function addHtmlAttribute($key, $value);
    public function getHtmlAttribute($key);
    public function deleteHtmlAttribute($key);
    public function setHtmlAttributes($attribuetsList);
    public function initOnClickVue($vueMethod);
}

?>