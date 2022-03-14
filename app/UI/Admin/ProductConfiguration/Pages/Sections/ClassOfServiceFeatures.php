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
 * Time: 08:35
 * Class ClassOfServiceFeatures
 */
class ClassOfServiceFeatures extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Sections\BoxSectionExtended implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea
{
    use \ModulesGarden\Servers\ZimbraEmail\App\Traits\LangHandler;
    protected $id = "classOfServiceFeatures";
    protected $name = "classOfServiceFeatures";
    protected $title = "classOfServiceFeatures";
    public function initContent()
    {
        $this->loadCos();
    }
    public function loadCos()
    {
        $lang = $this->getLang();
        $left = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Sections\HalfPageCustomCosSection("left");
        $right = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Sections\HalfPageCustomCosSection("right");
        $manager = new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager();
        $repository = $manager->getApiByProduct($this->getRequestValue("id"))->soap->repository();
        $cos = $repository->cos->all();
        $this->cos = $cos;
        $pointer = 1;
        foreach ($cos as $key => $cosModel) {
            $id = "cos[" . $cosModel->getId() . "]";
            $quete = $cosModel->getMbMailQuote();
            $field = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\ExtendedInputField($cosModel->getId());
            $field->setFieldType(\ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\ExtendedInputField::TYPE_NUMBER);
            $field->addHtmlAttribute("min", \ModulesGarden\Servers\ZimbraEmail\App\Enums\Size::UNLIMITED);
            $field->setName($id);
            $field->setRawTitle($cosModel->getName() . " (" . $quete . " MB)");
            $field->setRawDescription(sprintf($lang->absoluteT("Enter to limit an accounts number of %s with quota %s MB or set -1 to unlimited"), ucfirst($cosModel->getName()), $quete));
            $field->setDefaultValue(\ModulesGarden\Servers\ZimbraEmail\App\Enums\Size::DEFAULT_NULL_VALUE);
            if ($pointer % 2 == 0) {
                $right->addField($field);
            } else {
                $left->addField($field);
            }
            $pointer++;
        }
        $this->addSection($left)->addSection($right);
    }
}

?>