<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Tasks;

class Job
{
    /**
     * @var Task[]
     */
    protected $tasks = [];
    public function __construct()
    {
    }
    public final function addTask(\ModulesGarden\Servers\ZimbraEmail\Core\Models\Tasks\Task $task)
    {
        $this->tasks[] = $task;
    }
    public final function addTasks($tasks)
    {
        foreach ($this->tasks as $task) {
            $this->addTask($task);
        }
    }
    public function run()
    {
        foreach ($this->tasks as $task) {
        }
    }
}

?>