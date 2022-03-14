<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Lang;

/**
 * Simple class to translating languages
 * @author Michal Czech <michael@modulesgarden.com>
 * @SuppressWarnings(PHPMD)
 */
class Lang
{
    /**
     * @var string
     */
    private $dir = NULL;
    private $isDebug = NULL;
    /**
     * @var Array
     */
    private $langs = [];
    /**
     * @var type
     */
    private $currentLang = NULL;
    /**
     * @var bool
     */
    private $fillLangFile = true;
    /**
     * @var array
     */
    public $context = [];
    /**
     * @var array
     */
    private $staggedContext = [];
    /**
     * @var array
     */
    private $missingLangs = [];
    private $langReplacements = [];
    public function __construct($dir = NULL, $lang = NULL)
    {
        $this->setDir($dir);
        $this->isDebug = (int) (int) ModulesGarden\Servers\ZimbraEmail\Core\Helper\sl("configurationAddon")->getConfigValue("debug", false);
        if (!$lang) {
            $lang = $this->getLang();
        }
        if ($lang) {
            $this->setLang($lang);
        }
    }
    public function setDir($dir = NULL)
    {
        if ($dir !== NULL && $dir !== "") {
            $this->dir = $dir;
        } else {
            $this->dir = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getLangsDir();
        }
        return $this;
    }
    public function setLang($lang = "english")
    {
        if ($lang) {
            $this->loadLang($lang);
        } else {
            $this->loadLang("english");
        }
        return $this;
    }
    public function getMissingLangs()
    {
        return $this->missingLangs;
    }
    public function getLang()
    {
        $language = "";
        if (isset($_SESSION["Language"])) {
            $language = strtolower($_SESSION["Language"]);
            if (!$this->checkIfLangFileExists($language)) {
                $language = "";
            }
        }
        if (!$language && isset($_SESSION["uid"])) {
            $language = $this->getLangByUserId($_SESSION["uid"]);
            if (!$this->checkIfLangFileExists($language)) {
                $language = "";
            }
        }
        if (!$language) {
            $language = $this->getDefaultConfigLang();
            if (!$this->checkIfLangFileExists($language)) {
                $language = "";
            }
        }
        if (!$language) {
            $language = "english";
        }
        return strtolower($language);
    }
    protected function getLangByUserId($uid = NULL)
    {
        while ($uid) {
            return false;
        }
        try {
            $cModle = new \ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs\Client();
            $res = $cModle->where("id", $uid)->first(["language"])->toArray();
            return $res["language"];
        } catch (\Exception $exc) {
            return false;
        }
    }
    protected function getDefaultConfigLang()
    {
        try {
            $cModle = new \ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs\Configuration();
            $res = $cModle->where("setting", "Language")->first(["value"])->toArray();
            return $res["value"];
        } catch (\Exception $exc) {
            return false;
        }
    }
    protected function checkIfLangFileExists($langName = NULL)
    {
        if (is_string($langName)) {
            $file = $this->dir . DS . strtolower($langName) . ".php";
            if (file_exists($file)) {
                return true;
            }
        }
        return false;
    }
    public function getAvaiable()
    {
        $langArray = [];
        $handle = opendir($this->dir);
        while (false !== ($entry = readdir($handle))) {
            list($lang, $ext) = explode(".", $entry);
            if ($lang && isset($ext) && strtolower($ext) == "php") {
                $langArray[] = $lang;
            }
        }
        return $langArray;
    }
    public function loadLang($lang)
    {
        $file = $this->dir . DS . $lang . ".php";
        if (file_exists($file)) {
            include $file;
            $this->langs = array_merge($this->langs, $_LANG);
            $this->currentLang = $lang;
        }
    }
    public function setContext()
    {
        $this->context = [];
        foreach (func_get_args() as $name) {
            $this->context[] = $name;
        }
    }
    public function addToContext()
    {
        foreach (func_get_args() as $name) {
            $this->context[] = $name;
        }
    }
    public function stagCurrentContext($stagName)
    {
        $this->staggedContext[$stagName] = $this->context;
    }
    public function unstagContext($stagName)
    {
        if (isset($this->staggedContext[$stagName])) {
            $this->context = $this->staggedContext[$stagName];
            unset($this->staggedContext[$stagName]);
        }
    }
    public function translate()
    {
        $lang = $this->langs;
        $history = [];
        foreach ($this->context as $name) {
            if (isset($lang[$name])) {
                $lang = $lang[$name];
            }
            $history[] = $name;
        }
        $returnLangArray = false;
        foreach (func_get_args() as $find) {
            $find = trim($find);
            $history[] = $find;
            if (isset($lang[$find])) {
                if (is_array($lang[$find])) {
                    $lang = $lang[$find];
                } else {
                    $this->replaceConstantVars($lang[$find]);
                    return htmlentities($lang[$find]);
                }
            } else {
                if ($this->fillLangFile) {
                    $returnLangArray = true;
                } else {
                    return htmlentities($find);
                }
            }
        }
        if ($returnLangArray) {
            $this->addMissingLang($history, $returnLangArray);
            return $this->parserMissingLang($history);
        }
        if (is_array($lang) && $this->fillLangFile) {
            $this->addMissingLang($history);
            return $this->parserMissingLang($history);
        }
        return htmlentities($find);
    }
    public function tr()
    {
        return call_user_func_array([$this, "translate"], func_get_args());
    }
    public function T()
    {
        return call_user_func_array([$this, "translate"], func_get_args());
    }
    public function absoluteTranslate()
    {
        $lang = $this->langs;
        $returnLangArray = false;
        foreach (func_get_args() as $find) {
            $find = trim($find);
            $history[] = $find;
            if (isset($lang[$find])) {
                if (is_array($lang[$find])) {
                    $lang = $lang[$find];
                } else {
                    $this->replaceConstantVars($lang[$find]);
                    return htmlentities($lang[$find]);
                }
            } else {
                if ($this->fillLangFile) {
                    $returnLangArray = true;
                } else {
                    return htmlentities($find);
                }
            }
        }
        if ($returnLangArray) {
            $this->addMissingLang($history);
            return $this->parserMissingLang($history);
        }
        return htmlentities($lang);
    }
    public function abtr()
    {
        return call_user_func_array([$this, "absoluteTranslate"], func_get_args());
    }
    public function absoluteT()
    {
        return call_user_func_array([$this, "absoluteTranslate"], func_get_args());
    }
    public function controlerContextTranslate()
    {
        $tempContext = $this->context;
        $controlerContext = array_slice($tempContext, 0, 2);
        $this->context = $controlerContext;
        $args = func_get_args();
        $last = end($args);
        $lastKey = key($args);
        unset($args[$lastKey]);
        foreach ($args as $cont) {
            $this->context[] = $cont;
        }
        $result = $this->T($last);
        $this->context = $tempContext;
        return $result;
    }
    public function cctr()
    {
        return call_user_func_array([$this, "controlerContextTranslate"], func_get_args());
    }
    public function controlerContextT()
    {
        return call_user_func_array([$this, "controlerContextTranslate"], func_get_args());
    }
    protected function parserMissingLang($history)
    {
        if ($this->isDebug) {
            return "\$_LANG['" . implode("']['", $history) . "']";
        }
        return end($history);
    }
    protected function addMissingLang($history, $returnLangArray = false)
    {
        if ($returnLangArray) {
            $this->missingLangs["\$_LANG['" . implode("']['", $history) . "']"] = ucfirst(end($history));
        } else {
            $this->missingLangs["\$_LANG['" . implode("']['", $history) . "']"] = implode(" ", array_slice($history, -3, 3, true));
        }
    }
    public function addReplacementConstant($key, $value)
    {
        $this->langReplacements[$key] = $value;
        return $this;
    }
    protected function replaceConstantVars($langString)
    {
        if (count($this->langReplacements) === 0) {
            return false;
        }
        foreach ($this->langReplacements as $key => $value) {
            if (stripos($langString, ":" . $key . ":") !== false) {
                $langString = str_replace(":" . $key . ":", $value, $langString);
            }
        }
    }
}

?>