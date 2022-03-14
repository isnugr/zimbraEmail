<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Modals;

/**
 * BaseEditModal controller
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class BaseEditModal extends BaseModal
{
    protected $id = "baseEditModal";
    protected $name = "baseEditModal";
    protected $title = "baseEditModal";
    public function __construct($baseId = NULL)
    {
        parent::__construct($baseId);
        $this->setModalSizeMedium();
    }
}

?>