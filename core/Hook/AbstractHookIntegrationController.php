<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Hook;

/**
 * a base class for every hook integration controller
 */
abstract class AbstractHookIntegrationController
{
    /** @var null|string
     *  determines the file name to be integrated which
     *  if null, will not integrate
     */
    protected $fileName = NULL;
    /** @var null|array
     *  determines the $_REQUEST params for which the integration should be done
     *  if null, this condition will be skipped
     */
    protected $requestParams = NULL;
    /** @var null|callable
     * a callback for the admin area controller
     */
    protected $controllerCallback = NULL;
    /** @var null|string
     *  a jQuery selector determines a DOM object to which the Vue App should be added
     * e.g '#exampleDiv', '.btn-container:first'
     */
    protected $jqSelector = NULL;
    /** @var string
     * states what type of integration should be used
     */
    protected $integrationType = self::TYPE_APPEND;
    /** @var null|string
     * a js function name, just for custom integration type
     */
    protected $jsFunctionName = NULL;
    /** @var string
     * states what type of insert integration should be used
     */
    protected $insertIntegrationType = self::INSERT_TYPE_CONTENT;
    const TYPE_APPEND = "append";
    const TYPE_PREPEND = "prepend";
    const TYPE_REPLACE = "replace";
    const TYPE_CUSTOM = "custom";
    const TYPE_AFTER = "after";
    const TYPE_BEFORE = "before";
    const INSERT_TYPE_FULL = "full";
    const INSERT_TYPE_CONTENT = "content";
    const INSERT_TYPE_MC_CONTENT = "mc_content";
    public function setFileName($fileName)
    {
        if (is_string($fileName) && $fileName !== "" || $fileName === NULL) {
            $this->fileName = $fileName;
        }
        return $this;
    }
    public function setRequestParams($requestParams = NULL)
    {
        if (is_array($requestParams) || $requestParams === NULL) {
            $this->requestParams = $requestParams;
        }
        return $this;
    }
    public function setControllerCallback($controllerCallback)
    {
        $this->controllerCallback = $controllerCallback;
    }
    public function setJqSelector($jqSelector)
    {
        if (is_string($jqSelector) && $jqSelector !== "" || $jqSelector === NULL) {
            $this->jqSelector = $jqSelector;
        }
    }
    public function setIntegrationType($type = NULL)
    {
        if (in_array($type, $this->getAvailableIntegrationTypes())) {
            $this->integrationType = $type;
        }
        return $this;
    }
    public function setJsFunctionName($jsFunctionName)
    {
        if ($jsFunctionName !== "" && is_string($jsFunctionName)) {
            $this->jsFunctionName = $jsFunctionName;
        }
        return $this;
    }
    public function getJsFunctionName()
    {
        return $this->jsFunctionName;
    }
    public function getFileName()
    {
        return $this->fileName;
    }
    public function getRequestParams()
    {
        return $this->requestParams;
    }
    public function getControllerCallback()
    {
        return $this->controllerCallback;
    }
    public function getJqSelector()
    {
        return $this->jqSelector;
    }
    public function getIntegrationType()
    {
        return $this->integrationType;
    }
    public function getAvailableIntegrationTypes()
    {
        return [TYPE_APPEND, TYPE_PREPEND, TYPE_REPLACE, TYPE_CUSTOM, TYPE_AFTER, TYPE_BEFORE];
    }
    public function setIntegrationInsertType($type = NULL)
    {
        if (in_array($type, $this->getAvailableInsertIntegrationTypes())) {
            $this->insertIntegrationType = $type;
        }
        return $this;
    }
    public function getIntegrationInsertType()
    {
        return $this->insertIntegrationType;
    }
    public function getAvailableInsertIntegrationTypes()
    {
        return [INSERT_TYPE_CONTENT, INSERT_TYPE_FULL, INSERT_TYPE_MC_CONTENT];
    }
    public function addIntegration($fileName = NULL, $requestParams = NULL, $controllerCallback = NULL, $jqSelector = NULL, $integrationType = NULL, $jsFunctionName = NULL, $insertIntegrationType = NULL)
    {
        $this->setFileName($fileName);
        $this->setRequestParams($requestParams);
        $this->setControllerCallback($controllerCallback);
        $this->setJqSelector($jqSelector);
        $this->setIntegrationType($integrationType);
        $this->setJsFunctionName($jsFunctionName);
        $this->setIntegrationInsertType($insertIntegrationType);
    }
}

?>