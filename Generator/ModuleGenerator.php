<?php

namespace DNAFactory\DevKtm\Generator;

class ModuleGenerator extends AbstractGenerator
{
    protected function _generate()
    {
        $rootNamespace = $this->getRootNamespace();

        //////////////////////////////////////
        /// composer.json

        $jsonRootNamespace = $rootNamespace . '\\';
        $jsonRootNamespace = str_replace('\\', '\\\\', $jsonRootNamespace);

        $moduleName = $this->getModuleName();

        $template = $this->getTemplate('module/composer.json', ['DummyJsonRootNamespace'], [$jsonRootNamespace]);
        $this->putTemplate($template, 'composer.json');

        //////////////////////////////////////
        /// registration.php

        $template = $this->getTemplate('module/registration.php', ['DummyModuleName'], [$moduleName]);
        $this->putTemplate($template, 'registration.php');

        //////////////////////////////////////
        /// etc/module.xml

        $template = $this->getTemplate('module/module.xml', ['DummyModuleName'], [$moduleName]);
        $this->putTemplate($template, 'etc/module.xml');
    }
}
