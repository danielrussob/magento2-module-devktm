<?php

namespace DNAFactory\DevKtm\Generator;

class CommandGenerator extends AbstractGenerator
{
    protected $commandName;

    protected function _generate()
    {
        $commandName = $this->getCommandName();

        //////////////////////////////////////
        /// Command/ExampleCommand.php

        $commandNamespace = $this->getNamespace('Command\\'.$commandName);
        $className = $this->getClassName($commandName);
        $dummyFullClassName = $commandNamespace . '\\' . $className;

        $dummyItemName = $this->convertFullClassNameInXmlName($dummyFullClassName);

        $template = $this->getTemplate(
            'command/command.php',
            ['DummyNamespace', 'DummyClassName'],
            [$commandNamespace, $className]);
        $this->putTemplate($template, 'Command/'.$commandName.'.php');

        //////////////////////////////////////
        /// etc/di.xml

        $template = $this->getTemplate(
            'command/di.xml',
            ['DummyItemName', 'DummyFullClassName'],
            [$dummyItemName, $dummyFullClassName]
        );

        $directoryReader = $this->directoryReaderFactory->create($this->modulePath . '/etc');
        if (!$directoryReader->isExist('di.xml')) {
            $this->putTemplate($template, 'etc/di.xml');
        } else {
            $this->output->writeln("<error>XML merge are not implemented yet!</error>");
            $this->output->writeln("<error>Modify di.xml according to:</error>");
            $this->output->writeln("<info>" . $template . "</info>");
        }
    }

    public function setCommandName($commandName)
    {
        $this->commandName = $commandName;
    }

    public function getCommandName()
    {
        return $this->commandName;
    }
}
