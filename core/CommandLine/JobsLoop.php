<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\CommandLine;

class JobsLoop extends AbstractCommand
{
    /**
     * Loop interval in seconds
     * @var int
     */
    protected $loopInterval = 5;
    /**
     * @var int
     */
    protected $maxChildren = 5;
    /**
     * @var int
     */
    protected $tasksPerChildren = 10;
    protected final function configure()
    {
        self::configure();
    }
    protected final function setup()
    {
        $this->addOption("parent", \Symfony\Component\Console\Input\InputOption::VALUE_OPTIONAL, "Parent id", NULL);
        $this->addOption("id", \Symfony\Component\Console\Input\InputOption::VALUE_OPTIONAL, "Child id", NULL);
    }
    protected final function execute(InputInterface $input, OutputInterface $output)
    {
        $parent = $input->getOption("parent");
        $id = $input->getOption("id");
        $parentHypervior = new Hypervisor($this->getName());
        if (!$parent) {
            $parentHypervior->lock();
        } else {
            $parentHypervior->checkIfRunning();
        }
        if ($id) {
        }
        do {
            self::process($input, $output, new SymfonyStyle($input, $output));
            sleep($this->loopInterval);
        } while ($hypervisor->isStopped());
    }
    protected function processJobs($jobs)
    {
        foreach ($jobs as $job) {
        }
    }
}

?>