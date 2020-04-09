<?php

namespace DNAFactory\DevKtm\Command\Deploy;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;

class SlowCoffeeDeployCommand extends \DNAFactory\DevKtm\Command\AbstractCommand
{
    protected $name = "dna:deploy:slow-coffee";
    protected $description = "Shortcode for dna:clean:all-folders, setup:upgrade, setup:di:compile, cache:flush, dev:source-theme:deploy";

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $commands = [
            'dna:clean:all-folders',
            'setup:upgrade',
            'setup:di:compile',
            'cache:flush',
            'dev:source-theme:deploy',
        ];

        foreach ($commands as $command) {
            $this->runCommand($command, $output);
        }
    }

    protected function runCommand($commandName, $output)
    {
        $output->writeln("<info>Executing $commandName</info>");

        $command = $this->getApplication()->find($commandName);
        $arguments = ['command' => $commandName];
        $commandInput = new ArrayInput($arguments);
        $command->run($commandInput, $output);
    }
}
