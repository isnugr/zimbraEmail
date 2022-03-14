<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Pages;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 10.09.19
 * Time: 10:51
 * Class Accounts
 */
class Accounts extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataTable implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "accounts";
    protected $name = "accounts";
    protected $title = NULL;
    const STATUS_LABEL = ["active" => "success", "locked" => "default", "maintenance" => "warning", "closed" => "default", "lockout" => "info", "pending" => "warning", "default" => "default"];
    protected function loadHtml()
    {
        $this->addColumn((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column("mailbox"))->setOrderable(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataProviders\DataProvider::SORT_ASC)->setSearchable(true, \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column::TYPE_STRING))->addColumn((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column("date_created"))->setOrderable()->setSearchable(true))->addColumn((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column("date_created"))->setOrderable()->setSearchable(true))->addColumn((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column("last_login"))->setOrderable()->setSearchable(true))->addColumn((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column("quota"))->setOrderable()->setSearchable(true, \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column::TYPE_INT))->addColumn((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column("status"))->setOrderable()->setSearchable(true));
    }
    public function replaceFieldStatus($key, $row)
    {
        $status = STATUS_LABEL[$row[$key]] ? STATUS_LABEL[$row[$key]] : STATUS_LABEL["default"];
        $label = ModulesGarden\Servers\ZimbraEmail\Core\Helper\di("lang")->absoluteT("zimbra", "account", "status", $row[$key]);
        $field = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\EnabledField();
        $field->setRawType($status);
        $field->setRawTitle($label);
        return $field->getHtml();
    }
    public function replaceFieldLast_login($key, $row)
    {
        return $row[$key] ? $row[$key] : "-";
    }
    public function initContent()
    {
        $productManager = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Product\ProductManager();
        $productManager->loadByHostingId($this->getRequestValue("id"));
        $this->addMassActionButton(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Buttons\MassChangeStatusButton());
        $this->addMassActionButton(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Buttons\MassDeleteAccountButton());
        $this->addButton(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Buttons\AddAccountButton());
        $this->addActionButton(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Buttons\EditAccountButton());
        $this->addActionButton(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Buttons\DeleteAccountButton());
        $mailBox = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Buttons\LoginToPanelButton();
        $mailBox->setRawUrl(\ModulesGarden\Servers\ZimbraEmail\App\Helpers\BuildUrlExtended::getProvisioningUrl("webmail", true, true, "clientSso"))->setRedirectParams(["actionElementId" => "true"]);
        $actions = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Buttons\SpanDropdownButton("actions");
        $actions->addButton(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Buttons\ChangeStatusButton());
        $actions->addButton(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Buttons\ChangePasswordButton());
        if ($productManager->get("ca_logInToMailboxButton") === "on") {
            $actions->addButton($mailBox);
        }
        $this->addActionButton($actions);
    }
    public function loadData()
    {
        $hosting = \ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs\Hosting::where("id", $this->getRequestValue("id"))->first();
        $accounts = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByServer($hosting->server)->soap->repository()->accounts->getByDomainName($hosting->domain);
        $productManager = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Product\ProductManager();
        $productManager->loadByHostingId($hosting->id);
        if ($productManager->get("filterAccountsByCOS") === "on" && $productManager->get("cos_name") != \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository\ClassOfServices::CUSTOM_ZIMBRA) {
            $availableCoses = is_array($productManager->getSettingCos()) ? array_keys($productManager->getSettingCos()) : [$productManager->getSettingCos()];
            $filter = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Filters\EmailAccounts\FilterByCosId();
            $filter->setAvailableCoses($availableCoses);
            $accounts = $filter->filter($accounts);
        }
        $data = [];
        foreach ($accounts as $account) {
            $accountArray = ["id" => $account->getId(), "mailbox" => $account->getName(), "date_created" => \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Helpers\AccountHelper::getFormattedData($account->getDataResourceA("zimbraCreateTimestamp")), "last_login" => \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Helpers\AccountHelper::getFormattedData($account->getDataResourceA("zimbraLastLogonTimestamp"), "d/m/Y H:i"), "quota" => \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Helpers\AccountHelper::getQuotaAsMb($account->getDataResourceA("zimbraMailQuota")), "status" => $account->getDataResourceA("zimbraAccountStatus")];
            $data[] = $accountArray;
        }
        $dataProv = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataProviders\Providers\ArrayDataProvider();
        $dataProv->setDefaultSorting("mailbox", "ASC")->setData($data);
        $this->setDataProvider($dataProv);
    }
}

?>