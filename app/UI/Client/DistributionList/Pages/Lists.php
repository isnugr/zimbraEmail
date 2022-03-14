<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Pages;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 18.09.19
 * Time: 13:28
 * Class Lists
 */
class Lists extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataTable implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "lists";
    protected $name = "lists";
    protected $title = NULL;
    protected function loadHtml()
    {
        $this->addColumn((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column("email"))->setOrderable(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataProviders\DataProvider::SORT_ASC)->setSearchable(true, \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column::TYPE_STRING))->addColumn((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column("name"))->setOrderable()->setSearchable(true))->addColumn((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column("status"))->setOrderable()->setSearchable(true));
    }
    public function replaceFieldStatus($key, $row)
    {
        $enabled = $row[$key] === "enabled" ? true : false;
        $field = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\EnabledField();
        $field->setEnabled($enabled);
        $field->setRawTitle(ModulesGarden\Servers\ZimbraEmail\Core\Helper\di("lang")->absoluteT("zimbra", "account", "status", $row[$key]));
        return $field->getHtml();
    }
    public function initContent()
    {
        $this->addMassActionButton(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Buttons\MassDeleteListButton());
        $this->addButton(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Buttons\AddListButton());
        $this->addActionButton(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Buttons\EditListButton());
        $this->addActionButton(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Buttons\DeleteListButton());
    }
    public function loadData()
    {
        $hosting = \ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs\Hosting::where("id", $this->getRequestValue("id"))->first();
        $api = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByServer($hosting->server);
        $repository = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository($api->soap);
        $lists = $repository->lists->getAllDistributionListsByDomain($hosting->domain);
        $data = [];
        foreach ($lists as $list) {
            $tmp = ["id" => $list->getId(), "email" => $list->getName(), "name" => $list->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::ATTR_DISPLAY_NAME), "status" => $list->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::ATTR_MAIL_STATUS)];
            $data[] = $tmp;
        }
        $dataProv = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataProviders\Providers\ArrayDataProvider();
        $dataProv->setDefaultSorting("id", "ASC")->setData($data);
        $this->setDataProvider($dataProv);
    }
}

?>