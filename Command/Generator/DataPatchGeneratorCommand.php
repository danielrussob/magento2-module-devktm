<?php

namespace DNAFactory\DevKtm\Command\Generator;

use DNAFactory\DevKtm\Generator\CommandGenerator;

use DNAFactory\DevKtm\Generator\DbSchemaGenerator;
use DNAFactory\DevKtm\Generator\DataPatchGenerator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;

class DataPatchGeneratorCommand extends AbstractGeneratorCommand
{
    protected $name = "dna:make:data-patch";
    protected $description = "Generate a Data Patch";

    /**
     * @var DataPatchGenerator
     */
    protected $dataPatchGenerator;

    public function __construct(
        DataPatchGenerator $dataPatchGenerator
    ) {
        $this->dataPatchGenerator = $dataPatchGenerator;
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $moduleName = $input->getArgument(self::MODULE_NAME);

        $helper = $this->getHelper('question');
        $question = new Question('Patch name? [ExamplePatch]', 'ExamplePatch');
        $patchName = $helper->ask($input, $output, $question);

        $this->dataPatchGenerator->setIO($input, $output);
        $this->dataPatchGenerator->setModuleName($moduleName);
        $this->dataPatchGenerator->setPatchName($patchName);

        $this->dataPatchGenerator->generate();
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
