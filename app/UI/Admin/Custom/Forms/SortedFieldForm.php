<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Forms;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 11.09.19
 * Time: 11:23
 * Class SordetFieldForm
 */
class SortedFieldForm extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\BaseForm
{
    /**
     * @var string
     */
    protected $id = "sortedFieldForm";
    /**
     * @var string
     */
    protected $name = "sortedFieldForm";
    /**
     * @var string
     */
    protected $title = "sortedFieldForm";
    /**
     * @var array
     */
    protected $indexContainer = [];
    public function addField(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\BaseField $field, $index = 0)
    {
        $this->addIndex($field->getId(), $index);
        return self::addField($field);
    }
    public function addSection($section, $index = 0)
    {
        $this->addIndex($section->getId(), $index);
        return self::addSection($section);
    }
    public function addIndex($id, $index = 0)
    {
        while ($this->indexExists($index)) {
            $index++;
        }
        $this->indexContainer[$index] = $id;
    }
    public function getIndexById($id)
    {
        return array_search($id, $this->indexContainer);
    }
    public function indexExists($index)
    {
        return isset($this->indexContainer[$index]);
    }
    public function getSortedFields()
    {
        $tmp = [];
        foreach ($this->getFields() as $field) {
            $tmp[$this->getIndexById($field->getId())] = $field;
        }
        foreach ($this->getSections() as $field) {
            $tmp[$this->getIndexById($field->getId())] = $field;
        }
        ksort($tmp);
        return $tmp;
    }
}

?>