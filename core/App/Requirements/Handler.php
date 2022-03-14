<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements;

/**
 * Description of Handler
 *
 * @author INBSX-37H
 */
abstract class Handler
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Lang;
    protected $unfulfilledRequirements = [];
    protected function addUnfulfilledRequirement($message = NULL, $params = [])
    {
        if ($message) {
            $this->loadLang();
            $translated = $this->lang->absoluteTranslate("unfulfilledRequirement", $message);
            foreach ($params as $searchKey => $searchValue) {
                $translated = str_replace(":" . (int) $searchKey . ":", (int) $searchValue, $translated);
            }
            $this->unfulfilledRequirements[] = $translated;
        }
    }
    public function getUnfulfilledRequirements()
    {
        return $this->unfulfilledRequirements;
    }
}

?>