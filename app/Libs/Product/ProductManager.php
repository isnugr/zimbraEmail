<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Product;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 11.09.19
 * Time: 12:26
 * Class ProductManager
 */
class ProductManager
{
    use \ModulesGarden\Servers\ZimbraEmail\App\Traits\ConfigTrait;
    use \ModulesGarden\Servers\ZimbraEmail\App\Traits\ModuleConfigurationHandler;
    /**
     *
     * @var array
     */
    protected $cos = [];
    /**
     * @var array
     */
    protected $configOptCosLimits = [];
    /**
     * @var bool
     */
    protected $cosConfigOptionEnabled = false;
    /**
     * @var Hosting
     */
    protected $hosting = NULL;
    public function loadByHostingId($id)
    {
        $this->hosting = \ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs\Hosting::with("configOptions")->where("id", $id)->first();
        $this->loadById($this->hosting->packageid);
        $this->loadConfigOptions($this->hosting->configOptions);
        return $this;
    }
    public function loadById($id)
    {
        $config = \ModulesGarden\Servers\ZimbraEmail\App\Models\ProductConfiguration::where("product_id", $id)->get();
        foreach ($config as $conf) {
            $this->set($conf->setting, $conf->value);
        }
        return $this;
    }
    public function getHosting()
    {
        return $this->hosting;
    }
    public function loadConfigOptions($configOpt)
    {
        foreach ($configOpt as $opt) {
            if ((int) $opt->configOption->hidden !== true) {
                if ($opt->configOption->isLinkedToProduct($this->hosting->packageid)) {
                    $option = explode("|", $opt->configOption->optionname);
                    if (false !== strpos($option[0], \ModulesGarden\Servers\ZimbraEmail\App\Services\ConfigurableOptions\Strategy\Types\ClassOfServicesOptions::COS_CONFIG_OPT_PREFIX)) {
                        $this->addCosConfigOpt($option[0], $opt->qty);
                    } else {
                        if ((int) $opt->configOption->optiontype === \ModulesGarden\Servers\ZimbraEmail\App\Services\ConfigurableOptions\Helper\TypeConstans::QUANTITY) {
                            $this->set($option[0], $opt->qty);
                        } else {
                            if ((int) $opt->configOption->optiontype === \ModulesGarden\Servers\ZimbraEmail\App\Services\ConfigurableOptions\Helper\TypeConstans::DROPDOWN) {
                                $name = explode("|", $opt->subOption->optionname);
                                if ($option[0] === "cos") {
                                    $this->addCosConfigOpt($name[0], \ModulesGarden\Servers\ZimbraEmail\App\Enums\Size::UNLIMITED);
                                }
                                $this->set($option[0], $name[0]);
                            }
                        }
                    }
                }
            }
        }
        return $this;
    }
    public function addCosConfigOpt($cosName, $quantity = 0)
    {
        $cosName = str_replace(\ModulesGarden\Servers\ZimbraEmail\App\Services\ConfigurableOptions\Strategy\Types\ClassOfServicesOptions::COS_CONFIG_OPT_PREFIX, "", $cosName);
        $this->cos[$cosName] = $quantity;
        $this->configOptCosLimits[$cosName] = $quantity;
        $this->setCosConfigOptionEnabled(true);
        return $this;
    }
    public function getZimbraConfiguration()
    {
        foreach ($this->config as $name => $value) {
            if (false !== strpos($name, \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::ZIMBRA_PREFIX_SETTINGS)) {
                $tmp[$name] = $value;
            }
        }
        return $tmp;
    }
    public function getPasswordSettings()
    {
        $passwordSettings = [];
        $globalPasswordSetting = \ModulesGarden\Servers\ZimbraEmail\Core\FileReader\Reader::read(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getDevConfigDir() . DS . "passwordConfig.yml");
        foreach ($this->config as $name => $value) {
            if (false !== strpos($name, \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::PASSWORD_MIN_PREFIX_SETTINGS) || false !== strpos($name, \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::PASSWORD_MAX_PREFIX_SETTINGS)) {
                $passwordSettings[$name] = isset($value) && is_numeric($value) ? $value : $globalPasswordSetting->get($name);
            }
        }
        return !empty($passwordSettings) ? $passwordSettings : $globalPasswordSetting->get();
    }
    public function getSettingCos()
    {
        if ($this->get("cos_name") === \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository\ClassOfServices::CLASS_OF_SERVICE_QUOTA) {
            return $this->cos ? $this->cos : json_decode($this->get("cos"), true);
        }
        if ($this->get("cos_name") === \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository\ClassOfServices::ZIMBRA_CONFIG_OPTIONS) {
            return $this->cos;
        }
        if ($this->get("cos_name") !== \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository\ClassOfServices::CUSTOM_ZIMBRA) {
            return $this->get("cos_name");
        }
        return NULL;
    }
    public function isControllerAccessible($controller)
    {
        return $this->get($controller) === \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::SWITCHER_ENABLED;
    }
    public function isSidebarEnabled($name)
    {
        switch ($name) {
            case "emailAccount":
                $controller = \ModulesGarden\Servers\ZimbraEmail\App\Enums\ControllerEnums::EMAIL_ACCOUNT_PAGE;
                break;
            case "emailAlias":
                $controller = \ModulesGarden\Servers\ZimbraEmail\App\Enums\ControllerEnums::EMAIL_ALIAS_PAGE;
                break;
            case "distributionList":
                $controller = \ModulesGarden\Servers\ZimbraEmail\App\Enums\ControllerEnums::DISTRIBUTION_MAIL_PAGE;
                break;
            case "domainAlias":
                $controller = \ModulesGarden\Servers\ZimbraEmail\App\Enums\ControllerEnums::DOMAIN_ALIAS_PAGE;
                break;
            case "goWebmail":
                $controller = \ModulesGarden\Servers\ZimbraEmail\App\Enums\ControllerEnums::WEBMAIL_PAGE;
                break;
            default:
                return $this->isActionAccessible($controller);
        }
    }
    public function isActionAccessible($action)
    {
        return $this->get($action) === \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::SWITCHER_ENABLED;
    }
    public function getServerUrl()
    {
        if ($this->hosting) {
            $server = $this->hosting->server()->first();
            $hostname = $server->hostname ? $server->hostname : $server->ipaddress;
            $url = ($server->secure ? "https://" : "http://") . $hostname . ($server->secure ? ":" . \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::SECURE_PORT : ":" . \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::PORT) . "/";
            return $url;
        }
        return NULL;
    }
    public function getClientUrl()
    {
        if ($this->hosting) {
            $server = $this->hosting->server()->first();
            $hostname = $server->hostname ? $server->hostname : $server->ipaddress;
            $port = $server->secure === "on" ? $this->loadModuleData()->getAll()["clienPortSecure"] : $this->loadModuleData()->getAll()["clienPort"];
            $port = $port ? $port : \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Connection::CLIENT_PORT;
            $url = ($server->secure ? "https://" : "http://") . $hostname . ":" . $port . "/";
            return $url;
        }
        return NULL;
    }
    public function getConfigOptCosLimits()
    {
        return $this->configOptCosLimits;
    }
    public function setConfigOptCosLimits($configOptCosLimits)
    {
        $this->configOptCosLimits = $configOptCosLimits;
    }
    public function isCosConfigOptionEnabled()
    {
        return $this->cosConfigOptionEnabled;
    }
    public function setCosConfigOptionEnabled($cosConfigOptionEnabled)
    {
        $this->cosConfigOptionEnabled = $cosConfigOptionEnabled;
    }
}

?>