<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * Title elements related functions
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface TableLength
{
    protected $tableLength = 10;
    protected $tableLengthList = [10, 25];
    protected $isTableLengthInfinity = true;
    public function enabledTalbeLengthInfinity();
    public function disabledTalbeLengthInfinity();
    public function setTableLengthList($tableLengthList);
    public function getTableLengthList();
    public function setTableLength($tableLength);
    public function getTableLength();
}

?>