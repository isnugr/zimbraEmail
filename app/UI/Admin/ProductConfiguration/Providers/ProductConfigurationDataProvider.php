<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\ProductConfiguration\Providers;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 29.08.19
 * Time: 10:27
 * Class ProductConfigurationDataProvider
 */
class ProductConfigurationDataProvider extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\DataProviders\BaseDataProvider implements \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Interfaces\AdminArea
{
    use \ModulesGarden\Servers\ZimbraEmail\App\Traits\LangHandler;
    const FORM_DATA = ["acc_limit", "alias_limit", "cos_name", "login_link", "filterAccountsByCOS", "acc_size", "domain_alias_limit", "dist_list_limit", "domainMaxSize", "cos", "ca_emailAccountPage", "ca_distributionListPage", "ca_goToWebmailPage", "ca_emailAliasesPage", "ca_domainAliasesPage", "ca_logInToMailboxButton"];
    const PASSWORD_SETTINGS = ["minPassLength", "maxPassLength", "minPassLetters", "minPassNumbers", "minPassSpacialCase", "minPassUpperCase", "minPassLowerCase"];
    const FILED_NOT_UPDATED = ["login_link"];
    public function read()
    {
        $this->checkConfigOrLoadFromPrevious($this->getRequestValue("id"));
        $this->loadDefaultData();
        $this->overrideDefaultDataByProductConfig();
    }
    public function update()
    {
        $this->catchFormData();
        $cos = $this->formData["cos"];
        unset($this->formData["cos"]);
        $productId = $this->request->get("id");
        foreach ($this->formData as $key => $value) {
            \ModulesGarden\Servers\ZimbraEmail\App\Models\ProductConfiguration::updateOrCreate(["product_id" => $productId, "setting" => $key], ["value" => $value]);
        }
        \ModulesGarden\Servers\ZimbraEmail\App\Models\ProductConfiguration::updateOrCreate(["product_id" => $productId, "setting" => "cos"], ["value" => json_encode($cos)]);
    }
    protected function loadDefaultData()
    {
        $this->data["acc_limit"] = \ModulesGarden\Servers\ZimbraEmail\App\Enums\Size::DEFAULT_ACC_LIMIT;
        $this->data["acc_size"] = \ModulesGarden\Servers\ZimbraEmail\App\Enums\Size::DEFAULT_ACC_SIZE;
        $this->data["alias_limit"] = \ModulesGarden\Servers\ZimbraEmail\App\Enums\Size::DEFAULT_ALIAS_LIMIT;
        $this->data["domain_alias_limit"] = \ModulesGarden\Servers\ZimbraEmail\App\Enums\Size::DEFAULT_DOMAIN_ALIAS_LIMIT;
        $this->data["cos_name"] = \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository\ClassOfServices::CUSTOM_ZIMBRA;
        $this->data["dist_list_limit"] = \ModulesGarden\Servers\ZimbraEmail\App\Enums\Size::DEFAULT_DIST_ALIAS_LIMIT;
        $this->data["login_link"] = \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::DEFAULT_LOGIN_LINK;
        $this->data["domainMaxSize"] = \ModulesGarden\Servers\ZimbraEmail\App\Enums\Size::UNLIMITED;
        $this->availableValues["cos_name"] = [\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository\ClassOfServices::CUSTOM_ZIMBRA => $this->getLang()->absoluteT("addonAA", "configuration", "product", "zimbra", "cos", "Use Custom Settings"), \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository\ClassOfServices::ZIMBRA_CONFIG_OPTIONS => $this->getLang()->absoluteT("addonAA", "configuration", "product", "zimbra", "cos", "Allow clients to choose Class Of Service"), \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository\ClassOfServices::CLASS_OF_SERVICE_QUOTA => $this->getLang()->absoluteT("addonAA", "configuration", "product", "zimbra", "cos", "Allow clients to choose Class Of Service Quota Per Account")];
        $manager = new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager();
        $repository = $manager->getApiByProduct($this->getRequestValue("id"))->soap->repository();
        $cosList = $repository->cos->all();
        foreach ($cosList as $cos) {
            $this->availableValues["cos_name"][$cos->getId()] = $this->getLang()->absoluteT($cos->getName());
        }
    }
    protected function overrideDefaultDataByProductConfig()
    {
        $settings = \ModulesGarden\Servers\ZimbraEmail\App\Models\ProductConfiguration::where("product_id", $this->request->get("id"))->get();
        foreach ($settings as $setting) {
            if ("cos" === $setting->setting) {
                $this->data[$setting->setting] = json_decode($setting->value, true);
            } else {
                $this->data[$setting->setting] = $setting->value;
            }
        }
    }
    protected function catchFormData()
    {
        $params = array_merge(\ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::BASE_ACCOUNT_CONFIG, array_merge(FORM_DATA, PASSWORD_SETTINGS));
        foreach ($params as $name) {
            if ($value = $this->request->get($name)) {
                $this->formData[$name] = $value;
            } else {
                if (!in_array($name, FILED_NOT_UPDATED)) {
                    $this->formData[$name] = \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::SWITCHER_DISABLED;
                } else {
                    $this->formData[$name] = "";
                }
            }
        }
    }
    private function checkConfigOrLoadFromPrevious($id)
    {
        if (\ModulesGarden\Servers\ZimbraEmail\App\Models\ProductConfiguration::where("product_id", $id)->first()) {
            return NULL;
        }
        $migration = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Migrations\Drivers\Version1To2\Settings();
        $exists = \Illuminate\Database\Capsule\Manager::schema()->hasTable($migration->getFromTable());
        if (!$exists) {
            return NULL;
        }
        $previous = \Illuminate\Database\Capsule\Manager::table($migration->getFromTable())->where("product_id", $id)->get();
        $prodManager = new \ModulesGarden\Servers\ZimbraEmail\App\Models\ProductConfiguration();
        foreach ($previous as $setting) {
            $settings[$setting->product_id][$setting->setting] = $setting->value;
            $products[] = $setting->product_id;
        }
        foreach ($settings as $prodId => $settingsArray) {
            $attrs = $migration->updateValues($settingsArray, $prodId);
            foreach ($attrs as $key => $value) {
                $prodManager->updateOrCreate(["product_id" => $prodId, "setting" => $key], ["value" => $value]);
            }
        }
        foreach ($migration->getNewFields() as $key => $value) {
            $prodManager->updateOrCreate(["product_id" => $id, "setting" => $key], ["value" => $value]);
        }
    }
}

?>