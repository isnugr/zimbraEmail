<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DomainAlias\Pages;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 18.09.19
 * Time: 13:37
 * Class DomainAliases
 */
class DomainAliases extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataTable implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "lists";
    protected $name = "lists";
    protected $title = NULL;
    protected function loadHtml()
    {
        $this->addColumn((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column("name"))->setOrderable(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataProviders\DataProvider::SORT_ASC)->setSearchable(true, \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column::TYPE_STRING))->addColumn((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column("description"))->setOrderable()->setSearchable(true));
    }
    public function initContent()
    {
        $this->addMassActionButton(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DomainAlias\Buttons\MassDeleteDomainAliasButton());
        $this->addButton(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DomainAlias\Buttons\AddDomainAliasButton());
        $this->addActionButton(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DomainAlias\Buttons\DeleteDomainAliasButton());
    }
    public function loadData()
    {
        $hosting = \ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs\Hosting::where("id", $this->getRequestValue("id"))->first();
        $aliases = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByServer($hosting->server)->soap->repository()->domains->getAliases($hosting->domain);
        $data = [];
        foreach ($aliases as $domain) {
            $tmp = ["id" => $domain->getId(), "name" => $domain->getName(), "description" => $domain->getAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Domain::ATTR_DESCRIPTION)];
            $data[] = $tmp;
        }
        $dataProv = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataProviders\Providers\ArrayDataProvider();
        $dataProv->setDefaultSorting("name", "ASC")->setData($data);
        $this->setDataProvider($dataProv);
    }
}

?>