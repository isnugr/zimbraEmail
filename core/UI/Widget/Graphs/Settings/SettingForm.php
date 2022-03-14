<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Graphs\Settings;

/**
 * Description of SettingForm
 *
 * @author inbs
 */
class SettingForm extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\BaseForm
{
    protected $id = "settingForm";
    protected $name = "settingForm";
    protected $title = "settingForm";
    protected $providerClass = "ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Graphs\\Settings\\SettingDataProvider";
    protected $configFields = [];
    public function initContent()
    {
        $this->setFormType(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\FormConstants::UPDATE);
        if ($this->configFields) {
            foreach ($this->configFields as $field) {
                $this->addField($field);
            }
            $this->loadDataToForm();
            return $this;
        } else {
            $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Hidden();
            $field->initIds("setting");
            $this->addField($field);
            $request = ModulesGarden\Servers\ZimbraEmail\Core\Helper\sl("request");
            $lang = ModulesGarden\Servers\ZimbraEmail\Core\Helper\sl("lang");
            $customParams = json_decode(html_entity_decode($request->get("customParams", "{}")));
            $defaultFilter = json_decode(html_entity_decode($request->get("defaultFilter", "{}")));
            if ($defaultFilter->type) {
                switch ($defaultFilter->type) {
                    case \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Graphs\EmptyGraph::GRAPH_FILTER_TYPE_INT:
                        $startFilter = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Number();
                        $startFilter->initIds("start")->setDefaultValue($defaultFilter->default->start);
                        $endFilter = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Number();
                        $endFilter->initIds("end")->setDefaultValue($defaultFilter->default->end);
                        $this->addField($startFilter);
                        $this->addField($endFilter);
                        break;
                    case \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Graphs\EmptyGraph::GRAPH_FILTER_TYPE_STRING:
                    case \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Graphs\EmptyGraph::GRAPH_FILTER_TYPE_DATE:
                        $startFilter = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Select2vueByValueOnly("start");
                        $startFilter->setDefaultValue($defaultFilter->default->start);
                        $endFilter = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Select2vueByValueOnly("end");
                        $endFilter->setDefaultValue($defaultFilter->default->end);
                        if ($customParams->labels) {
                            $startFilter->setAvailableValues($customParams->labels);
                            $endFilter->setAvailableValues($customParams->labels);
                        }
                        $this->addField($startFilter);
                        $this->addField($endFilter);
                        break;
                }
            }
            if ($customParams->labels && $defaultFilter->displayEditColor) {
                foreach ($customParams->labels as $label) {
                    $colorPicker = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\ColorPicker($label);
                    $colorPicker->setRawTitle(str_replace(":labelName:", $label, $lang->T("labelColor")));
                    $this->addField($colorPicker);
                }
            }
            $this->loadDataToForm();
        }
    }
    public function setConfigFields($fieldsList = [])
    {
        if ($fieldsList) {
            $this->configFields = $fieldsList;
        }
        return $this;
    }
}

?>