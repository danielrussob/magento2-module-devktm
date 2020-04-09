<?php

namespace DNAFactory\DevKtm\Command\Generator;

use DNAFactory\DevKtm\Generator\CommandGenerator;

use DNAFactory\DevKtm\Generator\ObserverGenerator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

class ObserverGeneratorCommand extends AbstractGeneratorCommand
{
    protected $name = "dna:make:observer";
    protected $description = "Generate an Observer";

    /**
     * @var CommandGenerator
     */
    protected $commandGenerator;

    public function __construct(
        ObserverGenerator $commandGenerator
    ) {
        $this->commandGenerator = $commandGenerator;
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $moduleName = $input->getArgument(self::MODULE_NAME);

        $helper = $this->getHelper('question');
        $question = new Question('Observer name? [ExampleObserver]', 'ExampleObserver');
        $observerName = $helper->ask($input, $output, $question);

        $question = new ChoiceQuestion(
            'Select area',
            ['base', 'frontend', 'adminhtml'],
            'base'
        );
        $question->setErrorMessage('Invalid %s');
        $area = $helper->ask($input, $output, $question);

        $question = new Question('Event name? [controller_action_predispatch]', 'controller_action_predispatch');
        $eventName = $helper->ask($input, $output, $question);

        $this->commandGenerator->setIO($input, $output);
        $this->commandGenerator->setModuleName($moduleName);
        $this->commandGenerator->setObserverName($observerName);
        $this->commandGenerator->setArea($area);
        $this->commandGenerator->setEventName($eventName);

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
