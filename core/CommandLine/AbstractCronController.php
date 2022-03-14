<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\CommandLine;

if (class_exists("Thread")) {
    /**
     * Description of AbstractCronController
     *
     * @author Rafał
     */
    class AbstractCronController extends \Thread
    {
        protected $className = NULL;
        protected $cronManager = NULL;
        public function setCronManager($cronManager)
        {
            $this->cronManager = $cronManager;
            return $this;
        }
        public function setClassName($className)
        {
            $this->className = $className;
            return $this;
        }
        protected function updatePid()
        {
            CronManager::updatePids($this->className);
        }
    }
} else {
    class AbstractCronController
    {
    }
}

?>