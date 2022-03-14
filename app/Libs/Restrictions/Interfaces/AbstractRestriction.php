<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Restrictions\Interfaces;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 07.11.19
 * Time: 10:29
 * Class AbstractRestriction
 */
abstract class AbstractRestriction
{
    /**
     * @var bool
     */
    protected $throwError = false;
    /**
     * @var RuleInterface
     */
    protected $rule = NULL;
    /**
     * @var
     */
    public $errorMessage = NULL;
    /**
     * @var bool
     */
    public $isValid = self::STATUS_VALID;
    const STATUS_VALID = true;
    const STATUS_INVALID = false;
    public function __construct(RuleInterface $rule)
    {
        $this->rule = $rule;
    }
    public abstract function check();
    public function isThrowErrorEnabled()
    {
        return $this->throwError === true;
    }
    public function enableThrowError()
    {
        $this->throwError = true;
        return $this;
    }
    public function disableThrowError()
    {
        $this->throwError = true;
        return $this;
    }
    public function getRule()
    {
        return $this->rule;
    }
    public function setRule(RuleInterface $rule)
    {
        $this->rule = $rule;
    }
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }
    public function isValid()
    {
        return $this->isValid;
    }
    public function setIsValid($isValid)
    {
        $this->isValid = $isValid;
    }
}

?>