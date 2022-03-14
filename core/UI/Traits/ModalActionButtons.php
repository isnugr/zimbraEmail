<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * Modal Action Buttons related functions
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface ModalActionButtons
{
    protected $actionButtons = [];
    public function addActionButton($button);
    protected function addButtonToList($button);
    public function insertActionButton($buttonId);
    public function getActionButtons();
    protected function initActionButtons();
    public function replaceSubmitButton($button);
    public function replaceSubmitButtonClasses($classes);
    public function setSubmitButtonClassesDanger();
    public function removeActionButton($button);
    public function removeActionButtonByIndex($index);
}

?>