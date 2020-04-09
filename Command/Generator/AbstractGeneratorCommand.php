<?php

namespace DNAFactory\DevKtm\Command\Generator;

use DNAFactory\DevKtm\Generator\ModuleGenerator;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

abstract class AbstractGeneratorCommand extends \DNAFactory\DevKtm\Command\AbstractCommand
{
    const MODULE_NAME = 'module-name';

    protected function getArguments()
    {
        return [
            [self::MODULE_NAME, InputArgument::REQUIRED, 'The name of the module'],
        ];
    }
}
