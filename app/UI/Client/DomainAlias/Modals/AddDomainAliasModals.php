<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DomainAlias\Modals;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 18.09.19
 * Time: 13:39
 * Class AddDomainAliasModals
 */
class AddDomainAliasModals extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Modals\BaseEditModal implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "addDomainAliasModals";
    protected $name = "addDomainAliasModals";
    protected $title = "addDomainAliasModals";
    public function initContent()
    {
        $this->addForm(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DomainAlias\Forms\AddDomainAliasForm());
    }
}

?>