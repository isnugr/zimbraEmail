<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Helper;

/**
 * Autometes some of database queries
 *
 * @author
 */
class DatabaseHelper
{
    public function performQueryFromFile($file = "")
    {
        return $this->checkIsAllSuccess(array_map([$this, "execute"], $this->getQueries($file)));
    }
    protected function checkIsAllSuccess($array = [])
    {
        return in_array(false, $array, true);
    }
    protected function execute($query)
    {
        try {
            $pdo = \Illuminate\Database\Capsule\Manager::connection()->getPdo();
            if (empty($query) === false) {
                $statement = $pdo->prepare($query);
                $statement->execute();
            }
            $query = true;
        } catch (\PDOException $ex) {
            \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("errorManager")->addError("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Helper\\DatabaseHelper", $ex->getMessage(), ["query" => $query]);
            $query = false;
            return $query;
        }
    }
    protected function getQueries($file)
    {
        return array_filter(explode(";", \ModulesGarden\Servers\ZimbraEmail\Core\FileReader\Reader::read($file)->get()), function ($element) {
            $tElement = trim($element);
            if ($element === "" || $tElement === "") {
                return false;
            }
            return true;
        });
    }
}

?>