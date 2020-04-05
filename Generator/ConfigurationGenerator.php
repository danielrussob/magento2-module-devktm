<?php

namespace DNAFactory\DevKtm\Generator;

class ConfigurationGenerator extends AbstractGenerator
{
    protected $configurationName;

    protected function _generate()
    {
        $objectName = $this->getConfigurationName();

        //////////////////////////////////////
        /// Api/ExampleConfigurationInterface.php

        $dummyNamespace = $this->getNamespace('Api\\'.$objectName);
        $className = $this->getClassName($objectName);
        $dummyFullClassName = $dummyNamespace . '\\' . $className;
        $dataObjectInterfaceFullClassName = $dummyFullClassName;

        $template = $this->getTemplate(
            'configuration/configurationinterface.php',
            ['DummyNamespace', 'DummyClassName'],
            [$dummyNamespace, $className]
        );
        $this->putTemplate($template, 'Api/'.$objectName.'Interface.php');

        //////////////////////////////////////
        /// Helper/Config/ExampleConfiguration.php

        $dummyNamespace = $this->getNamespace('Helper\\Config\\'.$objectName);
        $className = $this->getClassName($objectName);
        $dummyFullClassName = $dummyNamespace . '\\' . $className;

        $template = $this->getTemplate(
            'configuration/configuration.php',
            ['DummyNamespace', 'DummyClassName', 'DummyInterfaceClassName'],
            [$dummyNamespace, $className, $dataObjectInterfaceFullClassName]);
        $this->putTemplate($template, 'Helper/Config/'.$objectName.'.php');

        //////////////////////////////////////
        /// etc/di.xml

        $template = $this->getTemplate(
            'configuration/di.xml',
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

        //////////////////////////////////////
        /// etc/config.xml

        $template = $this->getTemplate('configuration/config.xml');

        $directoryReader = $this->directoryReaderFactory->create($this->modulePath . '/etc');
        if (!$directoryReader->isExist('config.xml')) {
            $this->putTemplate($template, 'etc/config.xml');
        } else {
            $this->output->writeln("<error>XML merge are not implemented yet!</error>");
            $this->output->writeln("<error>Modify etc/config.xml according to:</error>");
            $this->output->writeln("<info>" . $template . "</info>");
        }

        //////////////////////////////////////
        /// etc/system.xml

        $template = $this->getTemplate('configuration/system.xml', ['VENDOR_NAMESPACE'], [$this->getModuleName()]);

        $directoryReader = $this->directoryReaderFactory->create($this->modulePath . '/etc');
        if (!$directoryReader->isExist('adminhtml/system.xml')) {
            $this->putTemplate($template, 'etc/adminhtml/system.xml');
        } else {
            $this->output->writeln("<error>XML merge are not implemented yet!</error>");
            $this->output->writeln("<error>Modify etc/adminhtml/system.xml according to:</error>");
            $this->output->writeln("<info>" . $template . "</info>");
        }

        //////////////////////////////////////
        /// etc/acl.xml

        $template = $this->getTemplate('configuration/acl.xml', ['VENDOR_NAMESPACE'], [$this->getModuleName()]);

        $directoryReader = $this->directoryReaderFactory->create($this->modulePath . '/etc');
        if (!$directoryReader->isExist('acl.xml')) {
            $this->putTemplate($template, 'etc/acl.xml');
        } else {
            $this->output->writeln("<error>XML merge are not implemented yet!</error>");
            $this->output->writeln("<error>Modify etc/acl.xml according to:</error>");
            $this->output->writeln("<info>" . $template . "</info>");
        }
    }

    public function getConfigurationName()
    {
        return $this->configurationName;
    }

    public function setConfigurationName($configurationName)
    {
        $this->configurationName = $configurationName;
    }
}
