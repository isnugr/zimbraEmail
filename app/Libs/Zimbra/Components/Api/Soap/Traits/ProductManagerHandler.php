<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Traits;

interface ProductManagerHandler
{
    /**
     * @var ProductManager
     */
    protected $productManager = NULL;
    public function getProductManager();
    public function setProductManager(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Product\ProductManager $productManager);
}

?>