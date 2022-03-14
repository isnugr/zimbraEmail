<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * Form Elements related functions
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface Form
{
    protected $submit = NULL;
    protected $formType = \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\FormConstants::UPDATE;
    protected $allowedActions = NULL;
    protected $confirmMessage = NULL;
    protected $translateConfirmMessage = true;
    protected $lang = NULL;
    protected $localLangReplacements = [];
    protected $defaultActions = NULL;
    public function disableTranslateConfirmMessage();
    public function isTranslateConfirmMessage();
    public function getAllowedActions();
    public function addDefaultActions($defaultAction);
    public function removeDefaultAction($defaultAction);
    protected function getDefaultActions();
    public function setAllowedActions($allowed);
    public function setFormType($type);
    public function setSubmit($button);
    public function getSubmitHtml();
    public function getFormType();
    public function setConfirmMessage($message, $replacementParams);
    public function getConfirmMessage();
    protected function loadLang();
    protected function addLangReplacements();
    protected function getFieldValueByName($fieldName);
    protected function addLocalLangReplacements($replacementParams);
}

?>