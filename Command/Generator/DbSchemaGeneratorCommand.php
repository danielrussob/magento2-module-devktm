<?php

namespace DNAFactory\DevKtm\Command\Generator;

use DNAFactory\DevKtm\Generator\CommandGenerator;

use DNAFactory\DevKtm\Generator\DbSchemaGenerator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;

class DbSchemaGeneratorCommand extends AbstractGeneratorCommand
{
    protected $name = "dna:make:db-schema";
    protected $description = "Generate a DB Schema";

    /**
     * @var DbSchemaGenerator
     */
    protected $dbSchemaGenerator;

    public function __construct(
        DbSchemaGenerator $dbSchemaGenerator
    ) {
        $this->dbSchemaGenerator = $dbSchemaGenerator;
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $moduleName = $input->getArgument(self::MODULE_NAME);

        $helper = $this->getHelper('question');
        $question = new Question('Table name? [nice_table]', 'nice_table');
        $tableName = $helper->ask($input, $output, $question);

        $this->dbSchemaGenerator->setIO($input, $output);
        $this->dbSchemaGenerator->setModuleName($moduleName);
        $this->dbSchemaGenerator->setTableName($tableName);

        $this->dbSchemaGenerator->generate();
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
