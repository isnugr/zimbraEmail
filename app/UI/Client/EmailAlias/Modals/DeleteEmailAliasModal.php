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
 * Time: 12:59
 * Class DeleteEmailAliasModal
 */
class DeleteEmailAliasModal extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Modals\BaseModal implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "deleteEmailAliasModal";
    protected $name = "deleteEmailAliasModal";
    protected $title = "deleteEmailAliasModal";
    public function initContent()
    {
        $this->setSubmitButtonClassesDanger();
        $this->setModalTitleTypeDanger();
        $this->addForm(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAlias\Forms\DeleteEmailAliasForm());
    }
}

?>