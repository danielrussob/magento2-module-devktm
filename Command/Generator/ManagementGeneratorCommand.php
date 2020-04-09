<?php

namespace DNAFactory\DevKtm\Command\Generator;

use DNAFactory\DevKtm\Generator\ManagementGenerator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;

class ManagementGeneratorCommand extends AbstractGeneratorCommand
{
    protected $name = "dna:make:management";
    protected $description = "Generate a Management (generic service)";

    /**
     * @var ManagementGenerator
     */
    protected $managementGenerator;

    public function __construct(
        ManagementGenerator $managementGenerator
    ) {
        $this->managementGenerator = $managementGenerator;
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $moduleName = $input->getArgument(self::MODULE_NAME);

        $helper = $this->getHelper('question');
        $question = new Question('Management name? [Example]', 'Example');
        $managementName = $helper->ask($input, $output, $question);

        $this->managementGenerator->setIO($input, $output);
        $this->managementGenerator->setModuleName($moduleName);
        $this->managementGenerator->setManagementName($managementName);

        $this->managementGenerator->generate();
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
