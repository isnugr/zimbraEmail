<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates;

/**
 *  Ajax Html Data Response
 */
class HtmlDataJsonResponse extends Response implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ResponseInterface
{
    protected $dataType = "htmlData";
}

?>