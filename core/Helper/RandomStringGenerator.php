<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Helper;

/**
 * Helper for generating random strings
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class RandomStringGenerator
{
    protected $stringLength = 10;
    protected $charSet = "";
    protected $upperCharSet = "QWERTYUIOPLKJHGFDSAZXCVBNM";
    protected $lowerCharSet = "qwertyuioplkjhgfdsazxcvbnm";
    protected $numbersCharSet = "0123456789";
    protected $useUppercase = false;
    protected $useLowercase = true;
    protected $useNumbers = true;
    public function __construct($stringLength = NULL, $useNumbers = true, $useLowercase = true, $useUppercase = false)
    {
        $this->setLength($stringLength);
        $this->setUseNumbers($useNumbers);
        $this->setUseUppercase($useUppercase);
        $this->setUseLowercase($useLowercase);
    }
    public function setLength($stringLength)
    {
        if (0 < (int) $stringLength) {
            $this->stringLength = (int) $stringLength;
        }
    }
    public function genRandomString($const = NULL)
    {
        $randString = "";
        while (strlen($randString) < $this->stringLength) {
            $number = rand(0, strlen($this->charSet) - 1);
            $randString .= $this->charSet[$number];
        }
        if (is_string($const)) {
            $randString = $const . "_" . $randString;
        }
        return $randString;
    }
    public function loadCharSet()
    {
        $this->charSet = "";
        if ($this->useNumbers) {
            $this->charSet .= $this->numbersCharSet;
        }
        if ($this->useLowercase) {
            $this->charSet .= $this->lowerCharSet;
        }
        if ($this->useUppercase) {
            $this->charSet .= $this->upperCharSet;
        }
        if ($this->charSet === "") {
            $this->charSet = $this->numbersCharSet . $this->lowerCharSet;
        }
    }
    public function setUseNumbers($value = true)
    {
        if (is_bool($value)) {
            $this->useNumbers = $value;
        }
        $this->loadCharSet();
    }
    public function setUseLowercase($value = true)
    {
        if (is_bool($value)) {
            $this->useLowercase = $value;
        }
        $this->loadCharSet();
    }
    public function setUseUppercase($value = true)
    {
        if (is_bool($value)) {
            $this->useUppercase = $value;
        }
        $this->loadCharSet();
    }
}

?>