<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Validators;

/**
 * BaseValidator
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
abstract class BaseValidator implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\BaseValidatorInterface
{
    protected $type = "php";
    protected $errorsList = [];
    protected $lang = NULL;
    protected abstract function validate($data, $additionalData);
    public function getErrorsList()
    {
        return $this->errorsList;
    }
    public function isValid($data, $additionalData = NULL)
    {
        $this->cleanErrorsList();
        return $this->validate($data, $additionalData);
    }
    protected function cleanErrorsList()
    {
        $this->errorsList = [];
    }
    protected function addValidationError($message, $isRaw = false, $constList = [])
    {
        if ($isRaw !== false) {
            $this->errorsList[] = $message;
        }
        $this->loadLang();
        foreach ($constList as $key => $value) {
            $this->lang->addReplacementConstant($key, $value);
        }
        $this->errorsList[] = $this->lang->absoluteT("FormValidators", $message);
        return $this;
    }
    protected function loadLang()
    {
        if ($this->lang === NULL) {
            $this->lang = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("lang");
        }
    }
}

?>