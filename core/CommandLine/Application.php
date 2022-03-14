<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\CommandLine;

class Application extends \Symfony\Component\Console\Application
{
    protected $dir = "";
    public function run()
    {
        $this->loadCommandsControllers($this->getCommands());
        self::run();
    }
    protected function getCommands()
    {
        $files = glob(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("app", $this->dir) . "/*.php");
        $commands = [];
        foreach ($files as $file) {
            $file = substr($file, strrpos($file, DIRECTORY_SEPARATOR) + 1);
            $file = substr($file, 0, strrpos($file, "."));
            $commands[] = $file;
        }
        return $commands;
    }
    protected function loadCommandsControllers($commands)
    {
        foreach ($commands as $command) {
            $class = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getRootNamespace() . "\\App\\" . $this->dir . "\\" . $command;
            $this->add(new $class());
        }
    }
}

?>