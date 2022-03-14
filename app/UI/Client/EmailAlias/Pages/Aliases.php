<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAlias\Pages;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 18.09.19
 * Time: 11:46
 * Class Aliases
 */
class Aliases extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataTable implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "emailAliases";
    protected $name = "emailAliases";
    protected $title = NULL;
    protected function loadHtml()
    {
        $this->addColumn((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column("account"))->setOrderable(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataProviders\DataProvider::SORT_ASC)->setSearchable(true, \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column::TYPE_STRING))->addColumn((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column("email_alias"))->setOrderable()->setSearchable(true));
    }
    public function initContent()
    {
        $this->addMassActionButton(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAlias\Buttons\MassDeleteEmailAliasButton());
        $addEmailAliasesButton = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAlias\Buttons\AddEmailAliasButton();
        if ($this->isCreateButtonDisabled()) {
            $addEmailAliasesButton->addHtmlAttribute("disabled", true);
        }
        $this->addButton($addEmailAliasesButton);
        $this->addActionButton(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAlias\Buttons\DeleteEmailAliasButton());
    }
    public function loadData()
    {
        $hosting = \ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs\Hosting::where("id", $this->getRequestValue("id"))->first();
        $aliases = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByServer($hosting->server)->soap->repository()->accounts->getAccountAliasesByDomainName($hosting->domain);
        $data = [];
        foreach ($aliases as $alias) {
            $tmp = ["id" => base64_encode(json_encode(["alias" => $alias->getAlias(), "accId" => $alias->getAccountId()])), "email_alias" => $alias->getAlias(), "account" => $alias->getAccountName()];
            $data[] = $tmp;
        }
        $dataProv = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataProviders\Providers\ArrayDataProvider();
        $dataProv->setDefaultSorting("account", "ASC")->setData($data);
        $this->setDataProvider($dataProv);
    }
    private function isCreateButtonDisabled()
    {
        $hid = $this->getRequestValue("id");
        $hosting = \ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs\Hosting::where("id", $hid)->first();
        $accounts = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByHosting($hid)->soap->repository()->accounts->getByDomainName($hosting->domain);
        return 0 >= count($accounts);
    }
}

?>