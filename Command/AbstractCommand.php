<?php

namespace DNAFactory\DevKtm\Command;

use DNAFactory\DevKtm\Generator\ModuleGenerator;
use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

abstract class AbstractCommand extends Command
{
    protected $name;
    protected $description;

    protected function configure()
    {
        $this->setName($this->name);
        $this->setDescription($this->description);

        foreach ($this->getArguments() as $argument) {
            $this->addArgument(...$argument);
        }

        foreach ($this->getOptions() as $option) {
            $this->addOption(...$option);
        }

        parent::configure();
    }

    protected function getArguments()
    {
        return [

        ];
    }

    protected function getOptions()
    {
        return [
            //['example1', 'e1', InputOption::VALUE_OPTIONAL, 'Optional value'],
            //['example2', null, InputOption::VALUE_REQUIRED, 'Required value'],
        ];
    }
}
