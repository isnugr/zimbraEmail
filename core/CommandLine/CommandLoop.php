<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\CommandLine;

class CommandLoop extends AbstractCommand
{
    /**
     * Loop interval in seconds
     * @var int
     */
    protected $loopInterval = 5;
    /**
     * Loop counter
     * @var int
     * @TODO remove me
     */
    private $loopCounter = 0;
    protected final function configure()
    {
        self::configure();
    }
    protected final function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
    {
        $hypervisor = new Hypervisor($this->getName(), $input->getOptions());
        do {
            $hypervisor->lock();
            self::execute($input, $output);
            $hypervisor->ping();
            $hypervisor->sleep($this->loopInterval);
            $this->loopCounter++;
        } while ($hypervisor->shouldBeStopped());
        $hypervisor->unlock();
    }
    protected final function getLoopCounter()
    {
        return $this->loopCounter;
    }
}

?>