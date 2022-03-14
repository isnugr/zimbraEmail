<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Modals;

/**
 * BaseModal controller
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class BaseModal extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\Forms;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\Modal;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\ModalActionButtons;
    protected $id = "baseModal";
    protected $name = "baseModal";
    protected $title = "baseModal";
    public function runInitContentProcess()
    {
        if ($this->getRequestValue("ajax", false) == 1) {
            self::runInitContentProcess();
        }
    }
}

?>