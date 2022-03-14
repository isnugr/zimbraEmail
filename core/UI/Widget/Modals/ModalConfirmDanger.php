<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Modals;

/**
 * Modal for confirmation of a dangerous action
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class ModalConfirmDanger extends BaseModal
{
    protected $id = "modalConfirmDanger";
    protected $name = "modalConfirmDanger";
    protected $title = "modalConfirmDanger";
    public function __construct($baseId = NULL)
    {
        parent::__construct($baseId);
        $this->setModalTitleTypeDanger();
    }
    public function preInitContent()
    {
        self::preInitContent();
        $this->initActionButtons();
        $this->setSubmitButtonClassesDanger();
    }
}

?>