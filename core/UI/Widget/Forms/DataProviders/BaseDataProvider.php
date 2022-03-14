<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\DataProviders;

/**
 * BaseDataProvider - form controler witch CRUD implementation
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
abstract class BaseDataProvider implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\FormDataProviderInterface
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\RequestObjectHandler;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\RequestFormDataHandler;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\WhmcsParams;
    protected $data = [];
    protected $availableValues = [];
    protected $loaded = false;
    protected $disabledList = [];
    protected $parentFormType = NULL;
    public function __construct()
    {
        $this->loadFormDataFromRequest();
    }
    public function create()
    {
    }
    public abstract function read();
    public abstract function update();
    public function delete()
    {
    }
    public function reload()
    {
        $this->read();
    }
    public function getValueById($id)
    {
        if ($this->data[$id] || $this->data[$id] === 0) {
            return $this->data[$id];
        }
        return NULL;
    }
    public function getAvailableValuesById($id)
    {
        if (is_array($this->availableValues[$id]) || 0 < count($this->availableValues[$id])) {
            return $this->availableValues[$id];
        }
        return NULL;
    }
    public function getData()
    {
        return $this->data;
    }
    public function isDisabledById($id)
    {
        if (in_array($id, $this->disabledList)) {
            return true;
        }
        return false;
    }
    public function initData()
    {
        if ($this->loaded === false) {
            $this->read();
            $this->loaded = true;
        }
    }
    protected function setData($data)
    {
        $this->data = $data;
        return $this;
    }
    protected function setDisabled($id)
    {
        if (!in_array($id, $this->disabledList)) {
            $this->disabledList[] = $id;
        }
    }
    protected function removeFromDisabled($id)
    {
        if (in_array($id, $this->disabledList)) {
            $key = array_search($id, $this->disabledList[]);
            if ($key) {
                unset($this->disabledList[$key]);
            }
        }
    }
    public function setParentFormType($formType = NULL)
    {
        if (is_string($formType) && $formType !== "") {
            $this->parentFormType = $formType;
        }
        return $this;
    }
    public function getParentFormType()
    {
        return $this->parentFormType;
    }
}

?>