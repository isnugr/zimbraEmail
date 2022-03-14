<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Enums;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 09.09.19
 * Time: 14:10
 * Class Zimbra
 */
class Zimbra
{
    const ATTR_ENABLED = "TRUE";
    const ATTR_DISABLED = "FALSE";
    const ENABLED = "enabled";
    const DISABLED = "disabled";
    const ENABLED_AS_INT = 1;
    const SECURE_PORT = 7071;
    const PORT = 7072;
    const CLIENT_PORT = 8443;
    const STATUS_ACCEPT = "ACCEPT";
    const STATUS_APPROVAL = "APPROVAL";
    const STATUS_REJECT = "REJECT";
    const ACC_STATUS_ACTIVE = "active";
    const ACC_STATUS_LOCKED = "locked";
    const ACC_STATUS_MAINTENANCE = "maintenance";
    const ACC_STATUS_CLOSED = "closed";
    const ACC_STATUS_LOCKOUT = "lockout";
    const ACC_STATUS_PENDING = "pending";
    const ACC_STATUS_SUSPEND = "suspended";
    const DEFAULT_LOGIN_LINK = "https://zimbra-server";
    const BASE_ACCOUNT_CONFIG = ["zimbraFeatureMailEnabled", "zimbraFeatureCalendarEnabled", "zimbraFeatureBriefcasesEnabled", "zimbraFeatureContactsEnabled", "zimbraFeatureTasksEnabled", "zimbraFeatureOptionsEnabled", "zimbraFeatureTaggingEnabled", "zimbraFeatureChangePasswordEnabled", "zimbraFeatureManageZimlets", "zimbraFeatureGalEnabled", "zimbraFeatureWebClientOfflineAccessEnabled", "zimbraFeatureImportFolderEnabled", "zimbraDumpsterEnabled", "zimbraFeatureSharingEnabled", "zimbraFeatureSkinChangeEnabled", "zimbraFeatureHtmlComposeEnabled", "zimbraFeatureMAPIConnectorEnabled", "zimbraFeatureTouchClientEnabled", "zimbraFeatureGalAutoCompleteEnabled", "zimbraFeatureExportFolderEnabled", "zimbraDumpsterPurgeEnabled", "zimbraFeatureMailPriorityEnabled", "zimbraImapEnabled", "zimbraFeatureImapDataSourceEnabled", "zimbraFeatureMailSendLaterEnabled", "zimbraFeatureFiltersEnabled", "zimbraFeatureNewMailNotificationEnabled", "zimbraFeatureReadReceiptsEnabled", "zimbraFeatureFlaggingEnabled", "zimbraPop3Enabled", "zimbraFeaturePop3DataSourceEnabled", "zimbraFeatureConversationsEnabled", "zimbraFeatureOutOfOfficeReplyEnabled", "zimbraFeatureIdentitiesEnabled", "zimbraFeatureDistributionListFolderEnabled", "zimbraFeatureGroupCalendarEnabled", "zimbraFeatureCalendarReminderDeviceEmailEnabled", "zimbraFeatureAdvancedSearchEnabled", "zimbraFeatureInitialSearchPreferenceEnabled", "zimbraFeatureSavedSearchesEnabled", "zimbraFeaturePeopleSearchEnabled", "zimbraFeatureSMIMEEnabled", "zimbraFeatureEwsEnabled"];
}

?>