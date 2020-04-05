<?php

namespace DNAFactory\DevKtm\Generator;

class DbSchemaGenerator extends AbstractGenerator
{
    protected $tableName;

    protected function _generate()
    {
        //////////////////////////////////////
        /// etc/db_schema.xml

        $template = $this->getTemplate(
            'dbschema/db_schema.xml',
            ['DummyTableName'],
            [$this->getTableName()]
        );

        $directoryReader = $this->directoryReaderFactory->create($this->modulePath . '/etc');
        if (!$directoryReader->isExist('db_schema.xml')) {
            $this->putTemplate($template, 'etc/db_schema.xml');
        } else {
            $this->output->writeln("<error>XML merge are not implemented yet!</error>");
            $this->output->writeln("<error>Modify etc/db_schema.xml according to:</error>");
            $this->output->writeln("<info>" . $template . "</info>");
        }
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    public function getTableName()
    {
        return $this->tableName;
    }
}
