<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * Icons related functions
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface TableRowCol
{
    protected $tableRowCol = "lu-col-md-12";
    public function setTableRowCol($tableRowCol);
    public function disableTableRowCol();
    public function getTableRowCol();
}

?>