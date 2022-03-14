<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\CommandLine;

/**
 * Description of AbstractCronController
 *
 * @author Rafał
 */
abstract class AbstractCronControllerWithoutThread
{
    protected $exit = true;
    protected $error = false;
    protected $isChild = false;
    protected $className = NULL;
    protected $child = 0;
    protected $childId = NULL;
    protected $parentId = NULL;
    protected $cronManager = NULL;
    protected $parentUserId = NULL;
    protected $parentGroupId = NULL;
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
        return $this;
    }
    public function setChildId($childId)
    {
        $this->childId = $childId;
        return $this;
    }
    public function ischild($isChild)
    {
        $this->isChild = $isChild;
        return $this;
    }
    public function setClassName($className)
    {
        $this->className = $className;
        return $this;
    }
    protected function canRunScript()
    {
        $run = true;
        foreach (\ModulesGarden\Servers\ZimbraEmail\Core\Models\CronTabs::get() as $cronTab) {
            if ($cronTab->name == \ModulesGarden\Servers\ZimbraEmail\Core\Models\CronTabs::DEFAULT_CRON_MANAGER_NAME && $cronTab->status == "stop") {
                $run = false;
            } else {
                if ($cronTab->name == $this->className && $cronTab->status == "stop") {
                    $run = false;
                }
            }
        }
        return $run;
    }
    protected function updatePid()
    {
        if ($this->isChild) {
            CronManager::updatePids($this->className, $this->childId);
            if ($this->parentGroupId === getmygid() && $this->parentUserId === getmyuid()) {
                $this->removePid();
            }
        }
        return $this;
    }
    protected function isExistPid()
    {
        if ($this->isChild) {
            return CronManager::existPids($this->className, $this->childId);
        }
        return $this->canRunScript();
    }
    protected function removePid()
    {
        if ($this->isChild) {
            CronManager::removePids($this->className, $this->childId);
        }
        return $this;
    }
    public abstract function run();
    public function isChildrenCreate()
    {
        return false;
    }
    public function getChildrenCount()
    {
        return $this->child;
    }
    public function setCronManager($cronManager)
    {
        $this->cronManager = $cronManager;
        return $this;
    }
    public function getIndexElements()
    {
        $childrenListIds = [];
        for ($key = 1; $key <= $this->getChildrenCount(); $key++) {
            $childrenListIds[] = $key;
        }
        return $childrenListIds;
    }
    public function start()
    {
        try {
            if ($this->isStart() === false) {
                if (0 < $this->child && $this->isChild === false) {
                    while ($this->canRunScript()) {
                        if ($this->isChildrenCreate()) {
                            $parentId = getmypid();
                            $parentUId = $this->parentUserId ? $this->parentUserId : getmyuid();
                            $parentGId = $this->parentGroupId ? $this->parentGroupId : getmygid();
                            foreach ($this->getIndexElements() as $key) {
                                if (!$this->cronManager->isChildRunning($this->className, $key)) {
                                    $phpInterpreter = PHP_BINARY ?: "php";
                                    $internalCronDumpFile = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("storage", "crons", "cronLog");
                                    exec($phpInterpreter . " " . \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getModuleRootDir() . DS . "cron" . DS . "cron.php " . $this->className . " --parent " . $parentId . " --parentuid " . $parentUId . " --parentgid " . $parentGId . " --child " . $key . " >> " . $internalCronDumpFile . " &");
                                }
                            }
                        }
                        $this->wait(4000000);
                    }
                } else {
                    if ($this->child === 0 && $this->isChild === false) {
                        $this->exit = false;
                        $this->run();
                    } else {
                        if ($this->isChild === true) {
                            $this->exit = false;
                            $this->run();
                            $this->removePid();
                            exit;
                        }
                    }
                }
            }
        } catch (\Exception $ex) {
            $this->error = $ex->getMessage();
        }
    }
    public function setParentGroupId($parentGroupId)
    {
        $this->parentGroupId = $parentGroupId;
        return $this;
    }
    public function setParentUserId($parentUserId)
    {
        $this->parentUserId = $parentUserId;
        return $this;
    }
    public function isStart()
    {
        return $this->exit === false;
    }
    public function wait($seconds = 500000)
    {
        usleep($seconds);
    }
    public function __destruct()
    {
        if ($this->error) {
            \ModulesGarden\Servers\ZimbraEmail\Core\Models\CronTabs::ifName($this->className)->addError($this->error);
        }
    }
}

?>