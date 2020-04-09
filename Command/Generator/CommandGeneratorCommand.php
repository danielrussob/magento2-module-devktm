<?php

namespace DNAFactory\DevKtm\Command\Generator;

use DNAFactory\DevKtm\Generator\CommandGenerator;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;

class CommandGeneratorCommand extends AbstractGeneratorCommand
{
    protected $name = "dna:make:command";
    protected $description = "Generate a Command";

    /**
     * @var CommandGenerator
     */
    protected $commandGenerator;

    public function __construct(
        CommandGenerator $commandGenerator
    ) {
        $this->commandGenerator = $commandGenerator;
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $moduleName = $input->getArgument(self::MODULE_NAME);

        $helper = $this->getHelper('question');
        $question = new Question('Command name? [ExampleCommand]', 'ExampleCommand');
        $commandName = $helper->ask($input, $output, $question);

        $this->commandGenerator->setIO($input, $output);
        $this->commandGenerator->setModuleName($moduleName);
        $this->commandGenerator->setCommandName($commandName);

        $this->commandGenerator->generate();
    }

    protected function getArguments()
    {
        return array_merge(parent::getArguments(), [

        ]);
    }

    protected function getOptions()
    {
        return array_merge(parent::getOptions(), [

        ]);
    }
}
