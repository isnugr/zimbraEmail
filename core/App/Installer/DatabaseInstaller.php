<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Installer;

class DatabaseInstaller
{
    protected $queryResults = [];
    const STATUS = "status";
    const STATUS_SUCCESS = "success";
    const STATUS_ERROR = "error";
    const RAW_QUERY = "rawQuery";
    const ERROR_MESSAGE = "errorMessage";
    const FILE = "file";
    public function performQueryFromFile($file = "")
    {
        $queries = $this->getQueries($file);
        array_map(function ($query) {
            $this->execute($query, $file);
        }, $queries);
    }
    protected function execute($query, $file)
    {
        try {
            $pdo = \Illuminate\Database\Capsule\Manager::connection()->getPdo();
            if (empty($query) === false) {
                $statement = $pdo->prepare($query);
                $statement->execute();
            }
            $this->queryResults[] = [STATUS => STATUS_SUCCESS, FILE => $file, RAW_QUERY => $query];
        } catch (\PDOException $exc) {
            $this->queryResults[] = [STATUS => STATUS_ERROR, ERROR_MESSAGE => $exc->getMessage(), FILE => $file, RAW_QUERY => str_replace(PHP_EOL, "<br>", $query)];
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
    public function isInstallCorrect()
    {
        foreach ($this->queryResults as $result) {
            if ($result[STATUS] === STATUS_ERROR) {
                return false;
            }
        }
        return true;
    }
    public function getFailedQueries()
    {
        $failedList = [];
        foreach ($this->queryResults as $result) {
            if ($result[STATUS] === STATUS_ERROR) {
                $failedList[] = $result;
            }
        }
        return $failedList;
    }
    public function getQueriesResults()
    {
        return $this->queryResults;
    }
}

?>