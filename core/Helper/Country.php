<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Helper;

/**
 * Description of Country
 *
 * @author inbs
 */
class Country
{
    protected $path = "";
    protected $type = "";
    protected $country = [];
    protected static $instance = NULL;
    public function __construct()
    {
        $GLOBALS;
        $GLOBALS;
        /* =& ; (=& ..?) easytoyou_error_decompile */
        $varsionArray = explode(".", $GLOBALS["CONFIG"]["Version"]);
        $varsion = $varsionArray[0] . "." . $varsionArray[1] . "." . $this->getOnlyNumber($varsionArray[2]);
        if (version_compare($varsion, "7.0.0", ">=")) {
            $this->path = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPathWhmcs("resources", "country", "dist.countries.json");
            $this->type = "json";
        } else {
            $this->path = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPathWhmcs("includes", "countries.php");
            $this->type = "php";
        }
        $this->initCountry();
    }
    protected function getOnlyNumber($string)
    {
        $length = strlen($string);
        $return = "";
        $i = 0;
        while ($i < $length) {
            if (is_numeric($string[$i])) {
                $return .= $string[$i];
                $i++;
            }
        }
        return $return;
    }
    protected function initCountry()
    {
        if ($this->type === "json") {
            foreach (\ModulesGarden\Servers\ZimbraEmail\Core\FileReader\Reader::read($this->path)->get() as $code => $data) {
                $this->country[$code] = $data["name"];
            }
        } else {
            \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::requireFile($this->path);
            $this->country = $countries;
        }
    }
    public function getFullName($code)
    {
        if (isset($this->country[$code])) {
            return $this->country[$code];
        }
        return NULL;
    }
    public function getCountry($withKey = true)
    {
        if ($withKey) {
            return $this->country;
        }
        $country = [];
        foreach ($this->country as $code => $name) {
            $country[] = ["code" => $code, "name" => $name];
        }
        return $country;
    }
    public function getCode($fullName)
    {
        if (in_array($fullName, $this->country, true)) {
            return array_search($fullName, $this->country, true);
        }
        return NULL;
    }
    public static function getInstance()
    {
        if (self::$instance === NULL) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

?>