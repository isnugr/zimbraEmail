<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Graphs\Settings;

/**
 * Description of SettingDataProvider
 *
 * @author inbs
 */
class SettingDataProvider extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\DataProviders\BaseModelDataProvider
{
    public function __construct()
    {
        parent::__construct("\\ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\ModuleSettings\\Model");
    }
    public function read()
    {
        $data = \ModulesGarden\Servers\ZimbraEmail\Core\Models\ModuleSettings\Model::where("setting", $this->getRequestValue("index", ""))->first();
        if ($data) {
            $this->data = json_decode($data->value, true);
        } else {
            $customParams = json_decode(html_entity_decode($this->getRequestValue("customParams", "{}")));
            $defaultFilter = json_decode(html_entity_decode($this->getRequestValue("defaultFilter", "{}")));
            $this->data["setting"] = $this->getRequestValue("index", "");
            if ($customParams->labels && $defaultFilter->displayEditColor) {
                foreach ($customParams->labels as $label) {
                    $this->data[$label] = "47FF44";
                }
            }
        }
    }
    public function update()
    {
        $query = \ModulesGarden\Servers\ZimbraEmail\Core\Models\ModuleSettings\Model::where("setting", $this->formData["setting"]);
        if (0 < $query->count()) {
            $query->update(["value" => json_encode($this->formData)]);
        } else {
            \ModulesGarden\Servers\ZimbraEmail\Core\Models\ModuleSettings\Model::create(["setting" => $this->formData["setting"], "value" => json_encode($this->formData)]);
        }
    }
}

?>