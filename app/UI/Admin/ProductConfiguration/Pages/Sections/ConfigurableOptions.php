<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\ProductConfiguration\Pages\Sections;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 29.08.19
 * Time: 08:32
 * Class ConfigurableOptionsSection
 */
class ConfigurableOptions extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Sections\BoxSectionExtended implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea
{
    use \ModulesGarden\Servers\ZimbraEmail\App\Traits\ZimbraApiHandler;
    protected $id = "configurableOptions";
    protected $name = "configurableOptions";
    protected $title = "configurableOptions";
    public function initContent()
    {
        $this->addButton(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\ProductConfiguration\Buttons\CreateConfigurableOptionsBaseModalButton());
    }
    public function getOptions()
    {
        $productId = $this->getRequestValue("id");
        $productManager = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Product\ProductManager();
        $productManager->loadById($productId);
        $options = new \ModulesGarden\Servers\ZimbraEmail\App\Services\ConfigurableOptions\Strategy\ConfigOptionsType();
        $options->setType($productManager->get(\ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::CLASS_OF_SERVICE_NAME));
        $options->setProductId($productId);
        $options->load();
        $configurableOptions = new \ModulesGarden\Servers\ZimbraEmail\App\Services\ConfigurableOptions\ConfigurableOptions($productId);
        \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\ProductConfiguration\Helper\ConfigurableOptionsBuilder::buildAll($configurableOptions, $options->getConfigurableOptions());
        $fields = $configurableOptions->show();
        $limit = count($fields) % 3;
        if (0 < $limit) {
            while ($limit < 3) {
                $fields["emptyFields" . $limit] = "-1";
                $limit++;
            }
        }
        return $fields;
    }
}

?>