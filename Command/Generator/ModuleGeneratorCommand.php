<?php

namespace DNAFactory\DevKtm\Command\Generator;

use DNAFactory\DevKtm\Generator\ModuleGenerator;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ModuleGeneratorCommand extends AbstractGeneratorCommand
{
    protected $name = "dna:make:module";
    protected $description = "Generate a module";

    /**
     * @var ModuleGenerator
     */
    private $moduleGenerator;

    public function __construct(
        ModuleGenerator $moduleGenerator
    ) {
        $this->moduleGenerator = $moduleGenerator;
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $moduleName = $input->getArgument(self::MODULE_NAME);

        $this->moduleGenerator->setIO($input, $output);
        $this->moduleGenerator->setModuleName($moduleName);

        $this->moduleGenerator->generate();
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
