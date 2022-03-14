<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\CommandLine;

/**
 * Description of AbstractReaderYml
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class ReaderCronTask
{
    /**
     * @var array
     */
    protected $data = [];
    public function __construct()
    {
        if (count($this->data) == 0) {
            $this->load();
        }
    }
    public function getData()
    {
        return $this->data;
    }
    protected function readYml($name)
    {
        return \ModulesGarden\Servers\ZimbraEmail\Core\FileReader\Reader::read($name)->get();
    }
    public static function get()
    {
        $instance = new self();
        return $instance->getData();
    }
    protected function load()
    {
        $this->data = $this->rebuildData($this->readYml(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("app", "Config", "cron.yml")));
    }
    protected function rebuildData($data)
    {
        $return = [];
        foreach ($data["list"] as $name => $isRun) {
            if ((int) $isRun) {
                $return[] = $name;
            }
        }
        return $return;
    }
}

?>