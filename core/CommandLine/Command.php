<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\CommandLine;

/**
 * Class Command
 * @package ModulesGarden\Servers\ZimbraEmail\Core\CommandLine
 */
class Command extends AbstractCommand
{
    protected final function configure()
    {
        self::configure();
    }
    protected final function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
    {
        return self::execute($input, $output, new \Symfony\Component\Console\Style\SymfonyStyle($input, $output));
    }
    protected function beforeProcess(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
    {
        (new Hypervisor($this->getName(), $input->getOptions()))->lock();
    }
    protected function afterProcess(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
    {
        (new Hypervisor($this->getName(), $input->getOptions()))->unlock();
    }
}

?>