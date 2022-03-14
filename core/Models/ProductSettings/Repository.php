<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Models\ProductSettings;

class Repository
{
    protected $modelInstance = NULL;
    public function __construct()
    {
        $this->modelInstance = new Model();
    }
    public function getProductSettings($pid = NULL)
    {
        $count = $this->modelInstance->where("pid", $pid)->count();
        if ($count === 0) {
            return [];
        }
        $data = $this->modelInstance->where("pid", $pid)->get()->toArray();
        $parsed = [];
        foreach ($data as $row => $values) {
            $parsed[$values["setting"]] = $values["setting"] === "securityGroups" ? json_decode($values["value"]) : $values["value"];
        }
        return $parsed;
    }
    public function updateProductSetting($pid = NULL, $setting = NULL, $value = "")
    {
        $count = $this->modelInstance->where("pid", $pid)->where("setting", $setting)->count();
        if (0 < $count) {
            $instance = $this->modelInstance->where("pid", $pid)->where("setting", $setting)->first();
            $instance->value = $value;
            return $instance->save();
        }
        return $this->modelInstance->fill(["pid" => $pid, "setting" => $setting, "value" => $value])->save();
    }
}

?>