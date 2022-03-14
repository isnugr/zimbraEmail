<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataProviders;

/**
 *
 */
class RawDataQuery
{
    private $query = NULL;
    private $params = [];
    private $limit = 10;
    private $offset = 0;
    private $orderColumn = false;
    private $orderDir = false;
    private $avalibleCols = [];
    private $toSearch = false;
    private $response = NULL;
    public function __construct($query, $params = [])
    {
        $this->query = $query;
        $this->params = $params;
        $this->response = new DataSet();
    }
    public function getData($avalibleCols = [])
    {
        $this->avalibleCols = $avalibleCols;
        if ($this->query) {
            $this->addSearch();
            $this->addSorting();
            $this->countRawResults();
            $this->addLimit();
            $statement = \Illuminate\Database\Capsule\Manager::connection()->getPdo()->prepare($this->query);
            $statement->execute($this->params);
            while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
                $this->response->records[] = $row;
            }
            return $this->response;
        }
        return $this->response;
    }
    public function countRawResults()
    {
        $statement = \Illuminate\Database\Capsule\Manager::connection()->getPdo()->prepare($this->query);
        $statement->execute($this->params);
        $this->response->fullDataLenght = $statement->rowCount();
    }
    public function addSearch()
    {
        if (!$this->toSearch) {
            return false;
        }
        $searchQuery = "";
        foreach ($this->avalibleCols as $column) {
            if ($column->searchable === true) {
                $searchQuery .= "OR " . $column->name . " LIKE :" . $column->name . " ";
                $this->params[$column->name] = "%" . $this->toSearch . "%";
            }
        }
        if ($searchQuery != "") {
            if (substr($searchQuery, 0, 2) === "OR") {
                $searchQuery = substr($searchQuery, 2);
            }
            $this->query .= "AND ( " . $searchQuery . " ) ";
        }
    }
    public function setLimit($limit)
    {
        $this->limit = (int) $limit;
    }
    public function setSearch($toSearch)
    {
        $this->toSearch = $toSearch;
    }
    public function setOffset($offset)
    {
        $this->offset = (int) $offset;
    }
    protected function addLimit()
    {
        $this->query .= " LIMIT " . $this->limit . " OFFSET " . $this->offset . " ";
        $this->response->offset = $this->offset;
    }
    protected function addSorting()
    {
        if ($this->orderColumn && $this->orderDir && $this->isProperColumn($this->orderColumn)) {
            $this->query .= " ORDER BY " . $this->orderColumn . " " . $this->orderDir . " ";
        }
    }
    public function setSorting($colName, $sortDir = DataProvider::SORT_ASC)
    {
        $this->orderColumn = $colName;
        $this->orderDir = $sortDir === strtolower(DataProvider::SORT_DESC) ? DataProvider::SORT_DESC : DataProvider::SORT_ASC;
    }
    protected function isProperColumn($colName)
    {
        foreach ($this->avalibleCols as $column) {
            if ($colName === $column->name) {
                return true;
            }
        }
        return false;
    }
}

?>