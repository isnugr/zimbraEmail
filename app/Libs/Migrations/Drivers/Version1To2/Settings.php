<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Migrations\Drivers\Version1To2;

/**
 * Class Settings
 * User: Nessandro
 * Date: 2019-11-12
 * Time: 19:47
 */
class Settings
{
    /**
     * @var string
     */
    protected $fromTable = "mg_prodConfig";
    /**
     * @var string
     */
    protected $toTable = "";
    public function getFromTable()
    {
        return $this->fromTable;
    }
    public function unsupported($key, $value)
    {
        if (strpos($key, "cos_") === 0) {
            $name = str_replace("cos_", "cosQuota_", $key);
            return [$name, $value];
        }
    }
    public function getMapped()
    {
        return ["acc_limit" => "acc_limit", "acc_size" => "acc_size", "alias_limit" => "alias_limit", "cos_name" => "cos_name", "dist_list_limit" => "dist_list_limit", "domainMaxSize" => "domainMaxSize", "domain_alias_limit" => "domain_alias_limit", "filterAccountsByCOS" => "filterAccountsByCOS", "login_link" => "login_link", "0" => "useCos", "zimbraDumpsterEnabled" => "zimbraDumpsterEnabled", "zimbraDumpsterPurgeEnabled" => "zimbraDumpsterPurgeEnabled", "zimbraFeatureAdvancedSearchEnabled" => "zimbraFeatureAdvancedSearchEnabled", "zimbraFeatureBriefcasesEnabled" => "zimbraFeatureBriefcasesEnabled", "zimbraFeatureCalendarEnabled" => "zimbraFeatureCalendarEnabled", "zimbraFeatureCalendarReminderDeviceEmailEnabled" => "zimbraFeatureCalendarReminderDeviceEmailEnabled", "1" => "zimbraFeatureChangePasswordEnabled", "2" => "zimbraFeatureContactsEnabled", "3" => "zimbraFeatureConversationsEnabled", "4" => "zimbraFeatureDistributionListFolderEnabled", "5" => "zimbraFeatureEwsEnabled", "6" => "zimbraFeatureExportFolderEnabled", "7" => "zimbraFeatureFiltersEnabled", "8" => "zimbraFeatureFlaggingEnabled", "9" => "zimbraFeatureGalAutoCompleteEnabled", "10" => "zimbraFeatureGalEnabled", "11" => "zimbraFeatureGroupCalendarEnabled", "12" => "zimbraFeatureHtmlComposeEnabled", "13" => "zimbraFeatureIdentitiesEnabled", "14" => "zimbraFeatureImapDataSourceEnabled", "15" => "zimbraFeatureImportFolderEnabled", "16" => "zimbraFeatureInitialSearchPreferenceEnabled", "17" => "zimbraFeatureMailEnabled", "18" => "zimbraFeatureMailPriorityEnabled", "19" => "zimbraFeatureMailSendLaterEnabled", "20" => "zimbraFeatureManageZimlets", "21" => "zimbraFeatureMAPIConnectorEnabled", "22" => "zimbraFeatureNewMailNotificationEnabled", "23" => "zimbraFeatureOptionsEnabled", "24" => "zimbraFeatureOutOfOfficeReplyEnabled", "25" => "zimbraFeaturePeopleSearchEnabled", "26" => "zimbraFeaturePop3DataSourceEnabled", "27" => "zimbraFeatureReadReceiptsEnabled", "28" => "zimbraFeatureSavedSearchesEnabled", "29" => "zimbraFeatureSharingEnabled", "30" => "zimbraFeatureSkinChangeEnabled", "31" => "zimbraFeatureSMIMEEnabled", "32" => "zimbraFeatureTaggingEnabled", "33" => "zimbraFeatureTasksEnabled", "34" => "zimbraFeatureTouchClientEnabled", "35" => "zimbraFeatureWebClientOfflineAccessEnabled", "36" => "zimbraImapEnabled", "37" => "zimbraPop3Enabled"];
    }
    public function updateValues($params, $prodId)
    {
        foreach ($params as $key => $value) {
            if (strpos($key, "cos_") === 0 && $key !== "cos_name") {
                $name = str_replace("cos_", "", $key);
                $cos[$name] = $value;
                unset($params[$key]);
            }
        }
        if ($cos) {
            $params["cos"] = json_encode($cos);
        }
        $defaultTypes = [\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository\ClassOfServices::CUSTOM_ZIMBRA, \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository\ClassOfServices::ZIMBRA_CONFIG_OPTIONS, \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository\ClassOfServices::CLASS_OF_SERVICE_QUOTA];
        if (!in_array($params["cos_name"], $defaultTypes)) {
            $manager = new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager();
            $repository = $manager->getApiByProduct($prodId)->soap->repository();
            $cosList = $repository->cos->all();
            foreach ($cosList as $cos) {
                $cosList[$cos->getName()] = $cos->getId();
            }
            $params["cos_name"] = $cosList[$params["cos_name"]];
        }
        return $params;
    }
    public function getNewFields()
    {
        return ["clientAreaFeaturesLeft" => "on", "ca_emailAccountPage" => "on", "ca_distributionListPage" => "on", "ca_goToWebmailPage" => "on", "clientAreaFeaturesRight" => "on", "ca_emailAliasesPage" => "on", "ca_domainAliasesPage" => "on"];
    }
}

?>