<?php

namespace DNAFactory\DevKtm\Command\Generator;

use DNAFactory\DevKtm\Generator\CommandGenerator;

use DNAFactory\DevKtm\Generator\DataObjectGenerator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;

class DataObjectGeneratorCommand extends AbstractGeneratorCommand
{
    protected $name = "dna:make:data-object";
    protected $description = "Generate Data Object";

    /**
     * @var DataObjectGenerator
     */
    protected $dataObjectGenerator;

    public function __construct(
        DataObjectGenerator $dataObjectGenerator
    ) {
        $this->dataObjectGenerator = $dataObjectGenerator;
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $moduleName = $input->getArgument(self::MODULE_NAME);

        $helper = $this->getHelper('question');
        $question = new Question('Data Object name? [Example]', 'Example');
        $objectName = $helper->ask($input, $output, $question);

        $this->dataObjectGenerator->setIO($input, $output);
        $this->dataObjectGenerator->setModuleName($moduleName);
        $this->dataObjectGenerator->setDataObjectName($objectName);

        $this->dataObjectGenerator->generate();
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
