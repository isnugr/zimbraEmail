<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * Modal Elements related functions
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface Modal
{
    protected $confirmTitle = "saveChanges";
    protected $cancelTitle = "cancel";
    protected $modalSize = "sm";
    protected $modalTitleType = "success";
    public function getConfirmTitle();
    public function setConfirmTitle($title);
    public function getCancelTitle();
    public function setCancelTitle($title);
    public function getModalSize();
    public function setModalSize($size);
    public function setModalSizeSmall();
    public function setModalSizeMedium();
    public function setModalSizeLarge();
    public function getModalTitleType();
    public function setModalTitleTypeDanger();
    public function setModalTitleTypeSuccess();
    public function setModalTitleTypeInfo();
    public function setModalTitleTypePrimary();
}

?>