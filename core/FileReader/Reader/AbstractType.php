<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\FileReader\Reader;

/**
 * Description of AbstractType
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
abstract class AbstractType
{
    protected $data = [];
    protected $renderData = [];
    protected $file = "";
    protected $path = "";
    public function __construct($file, $path, $renderData = [])
    {
        $this->file = $file;
        $this->path = $path;
        $this->renderData = $renderData;
        $this->loadFile();
    }
    protected abstract function loadFile();
    public function get($key = NULL, $default = NULL)
    {
        if ($key == NULL) {
            return $this->data;
        }
        if ($this->isExist($key)) {
            return $this->data[$key];
        }
        return $default;
    }
    protected function isExist($key)
    {
        if (isset($this->data[$key]) || array_key_exists($key, $this->data)) {
            return true;
        }
    }
}

?>