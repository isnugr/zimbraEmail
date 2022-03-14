<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAlias\Modals;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 18.09.19
 * Time: 11:50
 * Class AddEmailAliasModal
 */
class AddEmailAliasModal extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Modals\BaseEditModal implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "addEmailAliasModal";
    protected $name = "addEmailAliasModal";
    protected $title = "addEmailAliasModal";
    public function initContent()
    {
        $this->addForm(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAlias\Forms\AddEmailAliasForm());
    }
}

?>