<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\Datatable;

/**
 * Filters related functions
 * Filters Trait
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface Filters
{
    protected $filters = [];
    protected $filtersPerRow = 4;
    public function addFilter(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Filters\Helpers\FilterInterface $filter);
    public function getFilters();
    public function hasFilters();
    protected function initFiltersContainer();
    public function setFiltersPerRowCount($filtersCount);
    public function getFiltersPerRow();
}

?>