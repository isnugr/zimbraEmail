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
class AbstractCommand extends \Symfony\Component\Console\Command\Command
{
    /**
     * Command name
     * @var string
     */
    protected $name = NULL;
    /**
     * Command description
     * @var string
     */
    protected $description = "";
    /**
     * Command help text. Use --help to show
     * @var string
     */
    protected $help = "";
    protected function configure()
    {
        $this->setName($this->name)->setDescription($this->description)->setHelp($this->help)->addOption("force", "f", \Symfony\Component\Console\Input\InputOption::VALUE_OPTIONAL, "Force script to run, without checking if another instance is running", false);
        $this->setup();
    }
    protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
    {
        try {
            $this->beforeProcess($input, $output);
            $this->process($input, $output, new \Symfony\Component\Console\Style\SymfonyStyle($input, $output));
            $this->afterProcess($input, $output);
        } catch (\Exception $ex) {
            (new \Symfony\Component\Console\Style\SymfonyStyle($input, $output))->error($ex->getMessage());
            return 0;
        }
    }
    protected function setup()
    {
    }
    protected function process(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output, \Symfony\Component\Console\Style\SymfonyStyle $io)
    {
    }
    protected function beforeProcess(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
    {
    }
    protected function afterProcess(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
    {
    }
}

?>