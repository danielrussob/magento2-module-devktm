<?php

namespace DNAFactory\DevKtm\Generator;

class DataObjectGenerator extends AbstractGenerator
{
    protected $dataObjectName;

    protected function _generate()
    {
        $objectName = $this->getDataObjectName();

        //////////////////////////////////////
        /// Api/Data/DataObjectInterface.php

        $dummyNamespace = $this->getNamespace('Api\\Data\\'.$objectName);
        $className = $this->getClassName($objectName);
        $dummyFullClassName = $dummyNamespace . '\\' . $className;
        $dataObjectInterfaceFullClassName = $dummyFullClassName;

        $template = $this->getTemplate(
            'dataobject/dataobjectinterface.php',
            ['DummyNamespace', 'DummyClassName'],
            [$dummyNamespace, $className]
        );
        $this->putTemplate($template, 'Api/Data/'.$objectName.'Interface.php');

        //////////////////////////////////////
        /// Data/DataObject.php

        $dummyNamespace = $this->getNamespace('Data\\'.$objectName);
        $className = $this->getClassName($objectName);
        $dummyFullClassName = $dummyNamespace . '\\' . $className;

        $template = $this->getTemplate(
            'dataobject/dataobject.php',
            ['DummyNamespace', 'DummyClassName', 'DummyInterfaceClassName'],
            [$dummyNamespace, $className, $dataObjectInterfaceFullClassName]);
        $this->putTemplate($template, 'Data/'.$objectName.'.php');

        //////////////////////////////////////
        /// etc/di.xml

        $template = $this->getTemplate(
            'dataobject/di.xml',
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

    public function setDataObjectName($dataObjectName)
    {
        $this->dataObjectName = $dataObjectName;
    }

    public function getDataObjectName()
    {
        return $this->dataObjectName;
    }
}
