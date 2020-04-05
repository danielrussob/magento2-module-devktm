<?php

namespace DNAFactory\DevKtm\Command;

use DNAFactory\DevKtm\Generator\CommandGenerator;

use DNAFactory\DevKtm\Generator\ConfigurationGenerator;
use DNAFactory\DevKtm\Generator\DataObjectGenerator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;

class ConfigurationGeneratorCommand extends AbstractGeneratorCommand
{
    protected $name = "dna:make:configuration";
    protected $description = "Generate Configuration";

    /**
     * @var ConfigurationGenerator
     */
    protected $configurationGenerator;

    public function __construct(
        ConfigurationGenerator $configurationGenerator
    ) {
        $this->configurationGenerator = $configurationGenerator;
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $moduleName = $input->getArgument(self::MODULE_NAME);

        $helper = $this->getHelper('question');
        $question = new Question('DConfiguration name? [ExampleConfiguration]', 'ExampleConfiguration');
        $configurationName = $helper->ask($input, $output, $question);

        $this->configurationGenerator->setIO($input, $output);
        $this->configurationGenerator->setModuleName($moduleName);
        $this->configurationGenerator->setConfigurationName($configurationName);

        $this->configurationGenerator->generate();
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
