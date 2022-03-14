<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\LoggerManager\Pages;

/**
 * Description of Filters
 *
 * @author inbs
 */
class LoggerPage extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataTable implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea
{
    protected $id = "loggercont";
    protected $name = "loggercont";
    protected $title = NULL;
    protected $colorArray = NULL;
    protected function loadHtml()
    {
        $this->addColumn((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column("id"))->setOrderable(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataProviders\DataProvider::SORT_DESC)->setSearchable(true, \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column::TYPE_INT))->addColumn((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column("message"))->setOrderable()->setSearchable(true))->addColumn((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column("type"))->setOrderable()->setSearchable(true))->addColumn((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column("date"))->setSearchable(true, \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Column::TYPE_DATE)->setOrderable());
    }
    public function replaceFieldMessage($key, $row)
    {
        return html_entity_decode($row[$key]);
    }
    public function replaceFieldType($key, $row)
    {
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Others\Label())->initIds("label")->setMessage($row["typeLabel"])->setTitle($row["typeLabel"])->setColor($this->colorArray[$row[$key]]["color"])->setBackgroundColor($this->colorArray[$row[$key]]["backgroundColor"])->getHtml();
    }
    public function initContent()
    {
        $this->addActionButton(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\LoggerManager\Buttons\DeleteLoggerModalButton());
        $this->addMassActionButton(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\LoggerManager\Buttons\MassDeleteLoggerButton());
    }
    protected function loadData()
    {
        $collection = ModulesGarden\Servers\ZimbraEmail\Core\Helper\sl("entityLogger")->all();
        $data = [];
        foreach ($collection as $model) {
            $data[] = $model->toArray();
        }
        $dataProv = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataProviders\Providers\ArrayDataProvider();
        $dataProv->setDefaultSorting("id", "desc")->setData($data);
        $this->setDataProvider($dataProv);
    }
}

?>