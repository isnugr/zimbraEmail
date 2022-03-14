<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Http\Admin;

class PageNotFound extends \ModulesGarden\Servers\ZimbraEmail\Core\Http\AbstractController
{
    public function index()
    {
        $pageControler = new \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Http\PageNotFound();
        return $pageControler->execute();
    }
}

?>