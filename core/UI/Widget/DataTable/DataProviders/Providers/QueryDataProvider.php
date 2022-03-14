<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataProviders\Providers;

/**
 *
 */
class QueryDataProvider extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataProviders\DataProvider
{
    private $query = NULL;
    protected $unset = false;
    public function unsetSort()
    {
        $this->unset = true;
        return $this;
    }
    public function setData($query, $params = [])
    {
        $this->query = $query instanceof \Illuminate\Database\Query\Builder ? new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataProviders\DataQuery($query) : new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataProviders\RawDataQuery($query, $params);
        if ($this->unset === false) {
            $this->query->setSorting($this->orderColumn, $this->orderDir);
        }
        $this->query->setLimit($this->limit);
        $this->query->setOffset($this->offset);
        $this->query->setSearch($this->toSearch);
        return $this;
    }
    public function getData($avalibleCols = [])
    {
        return $this->query->getData($avalibleCols);
    }
    public function setDefaultSorting($column, $direction)
    {
        if (!$this->request->query->get("iSortCol_0") && !$this->request->query->get("sSortDir_0") && $this->unset === false) {
            $this->setSortBy($column);
            $this->setSortDir($direction);
            if ($this->query) {
                $this->query->setSorting($column, $direction);
            }
        }
        return $this;
    }
}

?>