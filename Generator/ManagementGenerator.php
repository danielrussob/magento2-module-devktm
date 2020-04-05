<?php

namespace DNAFactory\DevKtm\Generator;

class ManagementGenerator extends AbstractGenerator
{
    protected $managementName;

    protected function _generate()
    {
        $objectName = $this->getManagementName();

        //////////////////////////////////////
        /// Api/Data/ManagementInterface.php

        $dummyNamespace = $this->getNamespace('Api\\'.$objectName);
        $className = $this->getClassName($objectName);
        $dummyFullClassName = $dummyNamespace . '\\' . $className;
        $dataObjectInterfaceFullClassName = $dummyFullClassName;

        $template = $this->getTemplate(
            'management/managementinterface.php',
            ['DummyNamespace', 'DummyClassName'],
            [$dummyNamespace, $className]
        );
        $this->putTemplate($template, 'Api/'.$objectName.'Interface.php');

        //////////////////////////////////////
        /// Data/Management.php

        $dummyNamespace = $this->getNamespace('Management\\'.$objectName);
        $className = $this->getClassName($objectName);
        $dummyFullClassName = $dummyNamespace . '\\' . $className;

        $template = $this->getTemplate(
            'management/management.php',
            ['DummyNamespace', 'DummyClassName', 'DummyInterfaceClassName'],
            [$dummyNamespace, $className, $dataObjectInterfaceFullClassName]);
        $this->putTemplate($template, 'Management/'.$objectName.'.php');

        //////////////////////////////////////
        /// etc/di.xml

        $template = $this->getTemplate(
            'management/di.xml',
            ['DummyInterface', 'DummyConcrete'],
            [$dataObjectInterfaceFullClassName, $dummyFullClassName]
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

    public function setManagementName($managementName)
    {
        $this->managementName = $managementName;
    }

    public function getManagementName()
    {
        return $this->managementName;
    }
}
