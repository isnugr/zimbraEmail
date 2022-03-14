<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * Forms Elements related functions
 * In order to handle Multiple forms inside of modal
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface Forms
{
    /**
     * Forms List
     * @var Array
     */
    protected $forms = [];
    public function addForm(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\FormInterface $form);
    public function getForm($formId);
    public function getForms();
}

?>