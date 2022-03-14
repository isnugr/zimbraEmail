<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields;

/**
 * BaseField controler
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class Textarea extends BaseField
{
    protected $id = "textarea";
    protected $name = "textarea";
    protected $textAreaRows = NULL;
    protected $textAreaCols = NULL;
    public function isRows()
    {
        return isset($this->textAreaRows);
    }
    public function isCols()
    {
        return isset($this->textAreaCols);
    }
    public function setRows($rows)
    {
        $this->textAreaRows = (int) $rows;
        return $this;
    }
    public function setCols($cols)
    {
        $this->textAreaCols = (int) $cols;
        return $this;
    }
    public function getRows()
    {
        return $this->textAreaRows;
    }
    public function getCols()
    {
        return $this->textAreaCols;
    }
}

?>