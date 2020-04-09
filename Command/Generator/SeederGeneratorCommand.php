<?php

namespace DNAFactory\DevKtm\Command\Generator;

use DNAFactory\DevKtm\Generator\CommandGenerator;

use DNAFactory\DevKtm\Generator\DbSchemaGenerator;
use DNAFactory\DevKtm\Generator\SeederGenerator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;

class SeederGeneratorCommand extends AbstractGeneratorCommand
{
    protected $name = "dna:make:seeder";
    protected $description = "Generate a Seeder";

    /**
     * @var SeederGenerator
     */
    protected $seederGenerator;

    public function __construct(
        SeederGenerator $seederGenerator
    ) {
        $this->seederGenerator = $seederGenerator;
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $moduleName = $input->getArgument(self::MODULE_NAME);

        $helper = $this->getHelper('question');
        $question = new Question('Seeder name? [ExampleSeeder]', 'ExampleSeeder');
        $seederName = $helper->ask($input, $output, $question);

        $this->seederGenerator->setIO($input, $output);
        $this->seederGenerator->setModuleName($moduleName);
        $this->seederGenerator->setSeederName($seederName);

        $this->seederGenerator->generate();
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
