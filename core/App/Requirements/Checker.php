<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements;

/**
 * Description of Handler
 *
 * @author INBSX-37H
 */
class Checker
{
    /** 
     * \ModulesGarden\Servers\ZimbraEmail\Core\FileReader\PathValidator
     * @var type null|\ModulesGarden\Servers\ZimbraEmail\Core\FileReader\|\ModulesGarden\Servers\ZimbraEmail\Core\FileReader\Directory
     */
    protected $directoryHandler = NULL;
    protected $requirementsList = [];
    protected $checkResaults = [];
    const PATHS = NULL;
    public function __construct()
    {
        $this->directoryHandler = new \ModulesGarden\Servers\ZimbraEmail\Core\FileReader\Directory();
        $this->loadRequirements();
        $this->checkRequirements();
    }
    protected function loadRequirements()
    {
        foreach (PATHS as $path) {
            $this->loadClassesByPath($path);
        }
    }
    protected function loadClassesByPath($path)
    {
        $fullPath = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getModuleRootDir() . DIRECTORY_SEPARATOR . $path;
        $files = $this->directoryHandler->getFilesList($fullPath, ".php", true);
        $classNamespace = $this->getClassNamespaceByPath($path);
        foreach ($files as $file) {
            $className = $classNamespace . $file;
            if (class_exists($className) && is_subclass_of($className, "ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Requirements\\RequirementInterface")) {
                $this->requirementsList[] = $className;
            }
        }
    }
    protected function getClassNamespaceByPath($path)
    {
        $contextParts = explode("\\", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Requirements\\Checker");
        $coreParts = explode(DIRECTORY_SEPARATOR, $path);
        $allParts = array_merge([$contextParts[0], $contextParts[1]], $coreParts);
        array_walk($allParts, function ($item) {
            $item = ucfirst($item);
        });
        return "\\" . implode("\\", $allParts) . "\\";
    }
    protected function checkRequirements()
    {
        foreach ($this->requirementsList as $requirement) {
            $instance = \ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection\DependencyInjection::call($requirement);
            $handler = $instance->getHandlerInstance();
            $this->checkResaults = array_merge($this->checkResaults, $handler->getUnfulfilledRequirements());
        }
    }
    public function getUnfulfilledRequirements()
    {
        return $this->checkResaults;
    }
}

?>